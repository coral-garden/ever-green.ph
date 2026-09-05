@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/page-estimate.css') }}">
@endpush

@section('content')
  <main id="top">
  <!-- ===================== HERO ===================== -->
  <section class="est-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Solar estimator</div>
      <h1>Solar cost &amp; savings estimate for Siargao</h1>
      <p class="est-sub">Tell us your average monthly electricity bill and we'll estimate the system size, roof space, indicative cost, and savings — tuned for Siargao sun. Then send it over for a precise, no-obligation quote.</p>
      <p class="estimate-packages-link">Looking for a complete system? <a href="/solar/packages">Browse advertised packages →</a></p>
    </div>
  </section>

  <!-- ===================== CALCULATOR ===================== -->
  <section class="section calc" id="estimator">
    <!-- curved island-horizon seam (dark hero → paper) -->
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--paper)"/>
        <path d="M0 52 C360 4 1080 4 1440 52" fill="none" stroke="var(--lime)" stroke-width="2" stroke-dasharray="6 8" opacity=".55" vector-effect="non-scaling-stroke"/>
      </svg>
      <svg class="seam-badge" viewBox="0 0 64 64" aria-hidden="true">
        <circle cx="32" cy="32" r="29" fill="var(--lime)"/>
        <g transform="translate(32,32) scale(0.58) translate(-32,-32)" fill="none" stroke="var(--panel)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="32" cy="32" r="11" fill="var(--panel)" stroke="none"/>
          <path d="M32 10V3M32 61v-7M54 32h7M3 32h7M47 17l5-5M12 52l5-5M47 47l5 5M12 12l5 5"/>
        </g>
      </svg>
    </div>

    <div class="shell">
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Your estimate</div>
          <h2>Build your system</h2>
        </div>
        <p class="kicker">Move the sliders to see your numbers update live. Everything here is an indicative estimate — your final quote is sized to your exact load, roof, and site.</p>
      </div>

      <div class="calc-grid">
        <!-- ---------- INPUTS ---------- -->
        <form class="panel-card reveal" id="calcForm" autocomplete="off">
          <div class="field">
            <label for="bill">Average monthly electricity bill</label>
            <div class="bill-input">
              <span class="cur">₱</span>
              <input id="bill" name="bill" type="number" min="500" max="500000" step="100" value="10000" inputmode="numeric" aria-describedby="billHint" />
              <span class="per">/ month</span>
            </div>
            <input id="billRange" type="range" min="1000" max="80000" step="500" value="10000" aria-label="Monthly bill slider" />
            <div class="range-row"><span id="billHint">Typical home: ₱3,000 – ₱25,000</span></div>

            <!-- upload your bill (camera or file) -->
            <input id="billUpload" type="file" accept="image/*,application/pdf" class="file-hidden" />
            <button type="button" class="upload-cta" id="uploadCta">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M14.5 4h-5L8 6H5a2 2 0 0 0-2 2v9a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2V8a2 2 0 0 0-2-2h-3l-1.5-2Z"/><circle cx="12" cy="12.5" r="3.2"/></svg>
              <span class="up-text">
                <span class="up-title">Upload or photograph your bill</span>
                <small>Don't know your exact bill? Snap a photo — we'll read it.</small>
              </span>
            </button>
            <div class="upload-preview" id="uploadPreview" hidden>
              <img id="uploadThumb" alt="Bill preview" />
              <span class="up-doc" id="uploadDoc" hidden aria-hidden="true">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8" stroke-linecap="round" stroke-linejoin="round"><path d="M14 3H7a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h10a2 2 0 0 0 2-2V8z"/><path d="M14 3v5h5"/></svg>
              </span>
              <div class="up-meta">
                <span class="up-name" id="uploadName"></span>
                <span class="up-size" id="uploadSize"></span>
              </div>
              <button type="button" class="upload-remove" id="uploadRemove" aria-label="Remove file">&times;</button>
            </div>
            <div class="bill-parse" id="billParseMsg" role="status"></div>
          </div>

          <div class="field">
            <label for="savings">How much of your bill do you want to offset?</label>
            <input id="savings" type="range" min="30" max="100" step="5" value="80" aria-label="Savings target percent" />
            <div class="range-row"><span>Target offset</span><span class="range-val" id="savingsVal">80%</span></div>
          </div>

          <div class="field">
            <label>System type</label>
            <div class="seg" role="group" aria-label="System type">
              <button type="button" data-type="tied" aria-pressed="true">Grid-tied</button>
              <button type="button" data-type="hybrid" aria-pressed="false">Hybrid</button>
              <button type="button" data-type="off" aria-pressed="false">Off-grid</button>
            </div>
          </div>

          <details class="adv">
            <summary>Advanced assumptions</summary>
            <div class="adv-grid">
              <div class="af">
                <label for="rate">Editable planning rate ₱/kWh</label>
                <input id="rate" type="number" min="5" max="30" step="0.01" value="13.47" inputmode="decimal" />
              </div>
              <div class="af">
                <label for="psh">Peak sun hrs</label>
                <input id="psh" type="number" min="3" max="7" step="0.1" value="5.0" inputmode="decimal" />
              </div>
              <div class="af">
                <label for="panelW">Panel watts</label>
                <input id="panelW" type="number" min="300" max="700" step="10" value="550" inputmode="numeric" />
              </div>
            </div>
          </details>
        </form>

        <!-- ---------- RESULTS ---------- -->
        <div class="calc-out reveal">
          <div class="res-grid" id="results" aria-live="polite">
            <div class="res feature">
              <div class="k">Recommended system size</div>
              <div class="v"><span id="rKwp">5.0</span> kWp</div>
              <div class="d"><span id="rPanels">9</span> panels · approx. <span id="rRoof">23</span> m² of roof</div>
            </div>
            <div class="res">
              <div class="k">Indicative installed cost</div>
              <div class="v" id="rCost">₱170k–190k</div>
              <div class="d">Supply &amp; install range — confirmed on a site quote.</div>
            </div>
            <div class="res">
              <div class="k">Estimated monthly savings</div>
              <div class="v" id="rSaveMo">₱8,000</div>
              <div class="d"><span id="rSaveYr">₱96,000</span> per year</div>
            </div>
            <div class="res">
              <div class="k">Simple planning payback</div>
              <div class="v" id="rPayback">~4 yrs</div>
              <div class="d">Midpoint cost ÷ target savings; excludes financing, maintenance, component replacement, degradation, taxes, and changes in electricity pricing.</div>
            </div>
          </div>
          <p class="calc-note">
            <strong>Calculator figures use general planning assumptions. <a href="/solar/packages">See advertised package prices</a> for specific equipment bundles.</strong><br>
            The default <b>₱<span id="nRate">13.47</span>/kWh</b> value is an editable planning input, not a published current utility tariff;
            replace it with the energy charge shown on your bill. The calculation also uses <b><span id="nPsh">5.0</span> peak sun hours</b>
            and an 80% system-efficiency assumption. Savings assume self-consumption; exported surplus, changing tariffs, degradation,
            maintenance, financing, taxes, and component replacement are not modeled. Figures are indicative, not a formal quote.
          </p>
        </div>
      </div>

      <!-- ---------- LEAD FORM ---------- -->
      <div class="calc-lead panel-card reveal" id="quote">
        <form id="leadForm" action="/estimate/lead" method="POST"@if(session('lead_success')) style="display:none"@endif>
          @csrf
          @if($errors->any())
            <p class="lead-msg err" role="alert" style="margin-bottom:14px;">Please check the highlighted fields and try again.</p>
          @endif
          <div class="lead-head">
            <div class="tag tag-dot">Get a quote</div>
            <h2>{{ $selectedPackage ? 'Enquire about this package' : 'Get my detailed quote' }}</h2>
            @if($selectedPackage)
              <div class="selected-package">
                <strong>{{ $selectedPackage['name'] }} · {{ $selectedPackage['kva'] }} kVA hybrid</strong>
                <span>Advertised price ₱{{ number_format($selectedPackage['price']) }}</span>
                <a href="/solar/packages">Change package</a>
              </div>
              <p class="lead-intro">We'll review your roof, loads, and location, then confirm this package's fit and final price. Your enquiry includes the selected package. The calculator above is a separate planning tool.</p>
              <input type="hidden" name="solar_package" value="{{ $selectedPackageSlug }}" />
            @else
              <p class="lead-intro">We'll review your roof and load, then send a precise system design and price. No obligation. Your estimate above is attached automatically.</p>
            @endif
          </div>

          <div class="lead-grid">
            <div>
              <label for="lName">Name</label>
              <input id="lName" name="name" type="text" value="{{ old('name') }}" required />
            </div>
            <div>
              <label for="lPhone">Mobile</label>
              <input id="lPhone" name="mobile" type="tel" placeholder="0966 000 0000" value="{{ old('mobile') }}" required />
            </div>
            <div>
              <label for="lEmail">Email</label>
              <input id="lEmail" name="email" type="email" value="{{ old('email') }}" required />
            </div>
            <div>
              <label for="lCity">City / area</label>
              <input id="lCity" name="city" type="text" placeholder="e.g. General Luna" value="{{ old('city') }}" />
            </div>
            <div class="full">
              <label for="lMsg">Anything else? (optional)</label>
              <textarea id="lMsg" name="message" placeholder="Roof type, timeline, questions…">{{ old('message') }}</textarea>
            </div>
          </div>

          <!-- honeypot (spam trap) -->
          <input class="hp" type="text" name="_gotcha" tabindex="-1" autocomplete="off" aria-hidden="true" />
          <!-- email subject + auto-filled estimate snapshot -->
          <input type="hidden" name="division" value="solar" />
          <input type="hidden" name="_subject" value="New solar estimate lead — Evergreen" />
          <fieldset class="estimate-snapshot" id="estimateSnapshot" @disabled($selectedPackage !== null)>
          <input type="hidden" name="bill_php" id="hBill" />
          <input type="hidden" name="system_type" id="hType" />
          <input type="hidden" name="system_size_kwp" id="hKwp" />
          <input type="hidden" name="panels" id="hPanels" />
          <input type="hidden" name="target_offset_pct" id="hOffset" />
          <input type="hidden" name="est_cost_php" id="hCost" />
          <input type="hidden" name="est_monthly_savings_php" id="hSave" />
          </fieldset>

          <div class="lead-actions">
            <button class="btn btn-lime" type="submit">{{ $selectedPackage ? 'Send my package enquiry' : 'Send my estimate' }}
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
            <span class="lead-msg" id="leadMsg" role="status"></span>
          </div>
        </form>

        <div class="form-done" id="formDone"@if(session('lead_success')) style="display:block"@endif>
          <h3>Thanks — we've got it. 🌱</h3>
          <p>Your enquiry is on its way to the Evergreen team. We'll be in touch shortly to schedule a site assessment and send your detailed quote. For anything urgent, call <a href="tel:+639663051461" style="color:var(--foliage);font-weight:600;">0966 305 1461</a>.</p>
        </div>
      </div>

      <!-- ---------- CRAWLABLE METHODOLOGY & DECISION SUPPORT ---------- -->
      <section class="estimate-guide" id="methodology" aria-labelledby="methodology-title">
        <div class="estimate-guide-head reveal">
          <div>
            <div class="tag tag-dot">Transparent assumptions</div>
            <h2 id="methodology-title">How the Siargao solar estimate works</h2>
          </div>
          <p class="estimate-updated">Methodology displayed as of <time datetime="2026-08-26">26 August 2026</time>.</p>
        </div>

        <div class="method-grid">
          <article class="method-card reveal">
            <h3>System sizing method</h3>
            <ol>
              <li>Your monthly bill is divided by the electricity rate to estimate monthly energy use in kWh.</li>
              <li>That usage is multiplied by your chosen bill-offset target, then converted to a daily target.</li>
              <li>The daily target is divided by peak sun hours and an 80% system-efficiency allowance to estimate array size in kWp.</li>
              <li>Panel count uses the selected panel wattage. Roof area allows 2.6 m² per panel.</li>
            </ol>
            <p>The default inputs are an editable ₱13.47/kWh planning rate, 5.0 peak sun hours, 550W panels, and an 80% bill-offset target. The rate is not presented as a current utility tariff; replace it with the energy charge on your bill. You can also edit the sun hours, panel wattage, and offset.</p>
          </article>

          <article class="method-card reveal">
            <h3>Indicative cost method</h3>
            <p>The calculated array size is multiplied by the generalized Philippine planning band currently used by the calculator for the selected system type:</p>
            <dl class="cost-bands">
              <div><dt>Grid-tied</dt><dd>₱45,000–₱62,000 per kWp</dd></div>
              <div><dt>Hybrid</dt><dd>₱60,000–₱90,000 per kWp</dd></div>
              <div><dt>Off-grid</dt><dd>₱75,000–₱115,000 per kWp</dd></div>
            </dl>
            <p>These are broad internal planning assumptions, not current Evergreen package prices, supplier quotations, or a formal quote. Battery capacity, equipment selection, the roof, cable runs, logistics, site conditions, taxes, and permitting can materially change the formal quote.</p>
          </article>
        </div>

        <div class="scenario-block reveal">
          <div class="scenario-head">
            <h3>Typical grid-tied scenarios</h3>
            <p>Examples use the default assumptions above and an 80% bill-offset target.</p>
          </div>
          <div class="scenario-table-wrap">
            <table class="scenario-table">
              <thead>
                <tr>
                  <th scope="col">Monthly bill</th>
                  <th scope="col">Estimated array</th>
                  <th scope="col">Panels / roof</th>
                  <th scope="col">Indicative range</th>
                  <th scope="col">Target monthly savings</th>
                </tr>
              </thead>
              <tbody>
                <tr><td>₱5,000</td><td>2.5 kWp</td><td>5 / 13 m²</td><td>₱111k–₱153k</td><td>₱4,000</td></tr>
                <tr><td>₱10,000</td><td>4.9 kWp</td><td>9 / 23 m²</td><td>₱223k–₱307k</td><td>₱8,000</td></tr>
                <tr><td>₱25,000</td><td>12.4 kWp</td><td>23 / 60 m²</td><td>₱557k–₱767k</td><td>₱20,000</td></tr>
              </tbody>
            </table>
          </div>
        </div>

        <div class="estimate-scope-grid">
          <article class="scope-card reveal">
            <h3>What the online estimate considers</h3>
            <ul>
              <li>Your monthly bill and editable electricity rate</li>
              <li>Your target bill offset and selected system type</li>
              <li>Peak sun hours, system efficiency, and panel wattage</li>
              <li>Indicative array size, panel count, roof area, cost range, and self-consumption savings</li>
            </ul>
          </article>
          <article class="scope-card reveal">
            <h3>What your formal quote must confirm</h3>
            <ul>
              <li>Actual interval or monthly load profile and essential backup loads</li>
              <li>Roof condition, usable area, shading, mounting, and structural work</li>
              <li>Panel, inverter, battery, protection, monitoring, and warranty selections</li>
              <li>Cabling, trenching, delivery, access, permitting, utility, and net-metering requirements</li>
              <li>Exactly what is included, excluded, taxed, and warranted in the final price</li>
            </ul>
          </article>
        </div>

        <div class="estimate-projects reveal">
          <div class="scenario-head">
            <h3>Compare with completed Siargao installations</h3>
            <p>See the equipment and locations behind real Evergreen Solar projects.</p>
          </div>
          <div class="estimate-project-grid">
            <a href="/solar/projects/bamboo-surf">
              <strong>Bamboo Surf Beach Resort</strong>
              <span>Pacifico, San Isidro · hybrid solar with battery storage</span>
            </a>
            <a href="/solar/projects/sunlit-hostel">
              <strong>Sunlit Hostel Siargao</strong>
              <span>Catangnan, General Luna · hybrid solar with battery storage</span>
            </a>
            <a href="/solar/projects/filmegz-seaside">
              <strong>Filmegz Seaside Homestay</strong>
              <span>Santa Monica · off-grid solar with battery storage</span>
            </a>
          </div>
        </div>

        <div class="estimate-faq reveal">
          <div class="tag tag-dot">Solar estimate FAQ</div>
          <h3>Frequently asked questions</h3>
          <div class="faq-list">
            <details>
              <summary>How accurate is the online solar estimate?</summary>
              <p>It is a preliminary planning estimate based on the inputs and assumptions shown above. A formal design and quote requires your bill history, load profile, roof or site assessment, and equipment selection.</p>
            </details>
            <details>
              <summary>Why does the calculator start with my electricity bill?</summary>
              <p>It estimates energy use by dividing your monthly bill by the selected ₱/kWh rate. If your bill shows a different rate, update the advanced assumption or upload the bill so the calculator can use the detected figure.</p>
            </details>
            <details>
              <summary>Does the hybrid or off-grid estimate include a battery?</summary>
              <p>The system-type selection changes the indicative cost band, but it does not size a specific battery. Evergreen must confirm your essential loads, desired backup time, and operating pattern before specifying battery capacity and price.</p>
            </details>
            <details>
              <summary>Does the estimate promise a particular equipment warranty?</summary>
              <p>No. The calculator does not assign a warranty value. A formal quote must identify the exact manufacturer or provider, warranty term, exclusions, registration requirements, maintenance conditions, and responsible warranty party.</p>
            </details>
            <details>
              <summary>Does the savings figure include net-metering credits?</summary>
              <p>No. The calculator treats the target production as self-consumed energy. Exported surplus is credited differently, so a formal proposal must model expected daytime use and any applicable utility arrangement.</p>
            </details>
            <details>
              <summary>What happens after I request a quote?</summary>
              <p>The Evergreen Solar team reviews your bill, roof, loads, location, and backup goals, then confirms a system design, equipment list, project scope, and formal price.</p>
            </details>
          </div>
        </div>
      </section>
    </div>
  </section>
  </main>

  
@endsection

@push('scripts')
<script src="{{ assetv('assets/page-estimate.js') }}" defer></script>
@endpush
