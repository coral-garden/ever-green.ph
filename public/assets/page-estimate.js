  // ============================================================
  //  SOLAR ESTIMATOR  — all assumptions live here, easy to tune
  // ============================================================
  const CALC = {
    derate: 0.80,          // system efficiency
    panelArea: 2.6,        // m² per panel
    co2: 0.65,             // kg CO2 avoided per kWh (PH grid average)
    // installed cost band (₱ per kW), customer retail, by system type.
    // Derived from PH system-total norms (5kW ≈ ₱250–400k, 10kW ≈ ₱450–650k);
    // larger systems trend cheaper per kW. TUNE THESE to Evergreen's real pricing.
    costPerKw: { tied: [45000, 62000], hybrid: [60000, 90000], off: [75000, 115000] }
  };

  const peso0 = new Intl.NumberFormat('en-PH', { style: 'currency', currency: 'PHP', maximumFractionDigits: 0 });
  const pesoShort = (n) => {
    if (n >= 1_000_000) return '₱' + (n / 1_000_000).toFixed(n < 10_000_000 ? 1 : 0) + 'M';
    if (n >= 1000) return '₱' + Math.round(n / 1000) + 'k';
    return peso0.format(n);
  };

  // element refs
  const $ = (id) => document.getElementById(id);
  const billEl = $('bill'), billRange = $('billRange'), savingsEl = $('savings');
  const rateEl = $('rate'), pshEl = $('psh'), panelWEl = $('panelW');
  let systemType = 'tied';

  function num(el, fallback) {
    const v = parseFloat(el.value);
    return Number.isFinite(v) && v > 0 ? v : fallback;
  }

  function compute() {
    const bill   = num(billEl, 10000);
    const rate   = num(rateEl, 13.47);
    const psh    = num(pshEl, 5.0);
    const panelW = num(panelWEl, 550);
    const offset = parseFloat(savingsEl.value) / 100;

    const monthlyKwh = bill / rate;
    const targetKwh  = monthlyKwh * offset;
    const kWp        = (targetKwh / 30) / (psh * CALC.derate);
    const panels     = Math.max(1, Math.ceil((kWp * 1000) / panelW));
    const roof       = panels * CALC.panelArea;

    const [lo, hi]   = CALC.costPerKw[systemType];
    const costLo     = kWp * lo, costHi = kWp * hi, costMid = (costLo + costHi) / 2;

    const monthlySave = targetKwh * rate;
    const annualSave  = monthlySave * 12;
    const payback     = annualSave > 0 ? costMid / annualSave : 0;
    const annualKwh   = kWp * psh * 365 * CALC.derate;
    const co2t        = (annualKwh * CALC.co2) / 1000;

    // paint results
    $('rKwp').textContent    = kWp.toFixed(kWp < 10 ? 1 : 0);
    $('rPanels').textContent = panels;
    $('rRoof').textContent   = Math.round(roof);
    $('rCost').textContent   = pesoShort(costLo) + '–' + pesoShort(costHi);
    $('rSaveMo').textContent = peso0.format(Math.round(monthlySave));
    $('rSaveYr').textContent = peso0.format(Math.round(annualSave));
    $('rPayback').textContent = payback >= 0.5 ? '~' + payback.toFixed(1) + ' yrs' : '< 1 yr';
    $('rCo2').textContent    = co2t.toFixed(1) + ' t';
    $('nRate').textContent   = rate.toFixed(2);
    $('nPsh').textContent    = psh.toFixed(1);

    // mirror into hidden lead fields
    $('hBill').value   = Math.round(bill);
    $('hType').value   = { tied: 'Grid-tied', hybrid: 'Hybrid', off: 'Off-grid' }[systemType];
    $('hKwp').value    = kWp.toFixed(2);
    $('hPanels').value = panels;
    $('hOffset').value = Math.round(offset * 100);
    $('hCost').value   = Math.round(costLo) + '–' + Math.round(costHi);
    $('hSave').value   = Math.round(monthlySave);
  }

  // keep bill number + slider in sync
  billEl.addEventListener('input', () => {
    const v = parseFloat(billEl.value);
    if (Number.isFinite(v)) billRange.value = Math.min(billRange.max, Math.max(billRange.min, v));
    compute();
  });
  billRange.addEventListener('input', () => { billEl.value = billRange.value; compute(); });
  savingsEl.addEventListener('input', () => { $('savingsVal').textContent = savingsEl.value + '%'; compute(); });
  [rateEl, pshEl, panelWEl].forEach(el => el.addEventListener('input', compute));

  // system-type segmented control
  document.querySelectorAll('.seg button').forEach(btn => {
    btn.addEventListener('click', () => {
      document.querySelectorAll('.seg button').forEach(b => b.setAttribute('aria-pressed', 'false'));
      btn.setAttribute('aria-pressed', 'true');
      systemType = btn.dataset.type;
      compute();
    });
  });

  compute(); // initial paint

  // ---- upload your bill: local preview, then parse it and auto-fill the estimate ----
  const billUpload = $('billUpload'), uploadCta = $('uploadCta'), uploadPreview = $('uploadPreview');
  const parseMsg = $('billParseMsg');
  uploadCta.addEventListener('click', () => billUpload.click());
  billUpload.addEventListener('change', () => {
    const f = billUpload.files && billUpload.files[0];
    if (!f) return;
    $('uploadName').textContent = f.name;
    $('uploadSize').textContent = (f.size / 1048576).toFixed(2) + ' MB';
    const thumb = $('uploadThumb'), doc = $('uploadDoc');
    if (f.type.startsWith('image/')) {
      thumb.src = URL.createObjectURL(f); thumb.hidden = false; doc.hidden = true;
    } else {
      thumb.hidden = true; doc.hidden = false; // e.g. PDF
    }
    uploadCta.hidden = true;
    uploadPreview.hidden = false;
    parseBill(f);
  });
  $('uploadRemove').addEventListener('click', () => {
    const thumb = $('uploadThumb');
    if (thumb.src) URL.revokeObjectURL(thumb.src);
    billUpload.value = '';
    uploadPreview.hidden = true;
    uploadCta.hidden = false;
    if (parseMsg) { parseMsg.textContent = ''; parseMsg.className = 'bill-parse'; }
  });

  async function parseBill(file) {
    if (!parseMsg) return;
    parseMsg.className = 'bill-parse loading';
    parseMsg.textContent = 'Reading your bill…';
    try {
      const fd = new FormData();
      fd.append('file', file);
      const token = document.querySelector('meta[name="csrf-token"]');
      const res = await fetch('/estimate/parse-bill', {
        method: 'POST',
        body: fd,
        headers: { Accept: 'application/json', 'X-CSRF-TOKEN': token ? token.content : '' }
      });
      const data = await res.json().catch(() => ({}));
      if (!res.ok || !data.ok) {
        parseMsg.className = 'bill-parse err';
        parseMsg.textContent = data.message || 'Could not read the bill — enter your amount manually.';
        return;
      }
      const b = data.bill || {};
      // Setting both bill and rate keeps monthly kWh internally consistent (bill ÷ rate).
      if (b.amount != null) {
        billEl.value = Math.round(b.amount);
        if (billRange) billRange.value = Math.min(Number(billRange.max) || 80000, Math.max(Number(billRange.min) || 1000, Math.round(b.amount)));
      }
      if (b.rate != null && b.rate > 0) rateEl.value = b.rate;
      compute();
      const bits = [];
      if (b.amount != null) bits.push((b.currency ? b.currency + ' ' : '₱') + Number(b.amount).toLocaleString());
      if (b.kwh != null) bits.push(b.kwh + ' kWh');
      parseMsg.className = 'bill-parse ok';
      parseMsg.textContent = '✓ Read from your bill: ' + bits.join(' · ') + (b.provider ? ' — ' + b.provider : '');
    } catch (err) {
      parseMsg.className = 'bill-parse err';
      parseMsg.textContent = 'Network error reading the bill — enter your amount manually.';
    }
  }

  // ---- lead form: AJAX submit to our Laravel endpoint ----
  // The @csrf hidden field rides along automatically via FormData.
  const leadForm = $('leadForm');
  const leadMsg = $('leadMsg');
  leadForm.addEventListener('submit', async (e) => {
    e.preventDefault();
    compute(); // ensure hidden estimate fields are current
    leadMsg.className = 'lead-msg';
    leadMsg.textContent = 'Sending…';
    try {
      const res = await fetch(leadForm.action, {
        method: 'POST',
        body: new FormData(leadForm),
        headers: { Accept: 'application/json' }
      });
      if (res.ok) {
        leadForm.style.display = 'none';
        $('formDone').style.display = 'block';
        $('formDone').scrollIntoView({ behavior: reduce ? 'auto' : 'smooth', block: 'center' });
      } else {
        const data = await res.json().catch(() => ({}));
        // Laravel 422 shape: { message, errors: { field: [msg, ...] } }
        const msgs = data.errors ? Object.values(data.errors).flat() : [];
        leadMsg.className = 'lead-msg err';
        leadMsg.textContent = msgs.join(' ') || 'Something went wrong. Please call us instead.';
      }
    } catch (err) {
      leadMsg.className = 'lead-msg err';
      leadMsg.textContent = 'Network error — please try again or call 0966 305 1461.';
    }
  });
