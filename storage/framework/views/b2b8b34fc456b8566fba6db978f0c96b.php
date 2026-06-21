<?php $__env->startPush('head'); ?>
<link rel="stylesheet" href="/assets/page-estimate.css">
<?php $__env->stopPush(); ?>

<?php $__env->startSection('content'); ?>
  <main id="top">
  <!-- ===================== HERO ===================== -->
  <section class="est-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Solar estimator</div>
      <h1>Size your solar in 30 seconds</h1>
      <p class="est-sub">Tell us your average monthly electricity bill and we'll estimate the system size, roof space, indicative cost, and savings — tuned for Siargao sun. Then send it over for a precise, no-obligation quote.</p>
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
                <label for="rate">Rate ₱/kWh</label>
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
              <div class="k">Simple payback</div>
              <div class="v" id="rPayback">~4 yrs</div>
              <div class="d">Before the system runs free for 25+ yrs.</div>
            </div>
            <div class="res">
              <div class="k">CO₂ avoided</div>
              <div class="v" id="rCo2">4.7 t</div>
              <div class="d">Per year — like planting dozens of trees.</div>
            </div>
          </div>
          <p class="calc-note">
            Estimates use a <b>₱<span id="nRate">13.47</span>/kWh</b> rate, <b><span id="nPsh">5.0</span> peak sun hours</b>,
            and an 80% system efficiency for the Siargao region. Savings assume self-consumption; under net metering,
            exported surplus is credited at a lower (generation-only) rate. Figures are indicative, not a formal quote.
          </p>
        </div>
      </div>

      <!-- ---------- LEAD FORM ---------- -->
      <div class="calc-lead panel-card reveal" id="quote">
        <form id="leadForm" action="/estimate/lead" method="POST"<?php if(session('lead_success')): ?> style="display:none"<?php endif; ?>>
          <?php echo csrf_field(); ?>
          <?php if($errors->any()): ?>
            <p class="lead-msg err" role="alert" style="margin-bottom:14px;">Please check the highlighted fields and try again.</p>
          <?php endif; ?>
          <div class="lead-head">
            <div class="tag tag-dot">Get a quote</div>
            <h2>Get my detailed quote</h2>
            <p class="lead-intro">We'll review your roof and load, then send a precise system design and price. No obligation. Your estimate above is attached automatically.</p>
          </div>

          <div class="lead-grid">
            <div>
              <label for="lName">Name</label>
              <input id="lName" name="name" type="text" value="<?php echo e(old('name')); ?>" required />
            </div>
            <div>
              <label for="lPhone">Mobile</label>
              <input id="lPhone" name="mobile" type="tel" placeholder="0966 000 0000" value="<?php echo e(old('mobile')); ?>" required />
            </div>
            <div>
              <label for="lEmail">Email</label>
              <input id="lEmail" name="email" type="email" value="<?php echo e(old('email')); ?>" required />
            </div>
            <div>
              <label for="lCity">City / area</label>
              <input id="lCity" name="city" type="text" placeholder="e.g. General Luna" value="<?php echo e(old('city')); ?>" />
            </div>
            <div class="full">
              <label for="lMsg">Anything else? (optional)</label>
              <textarea id="lMsg" name="message" placeholder="Roof type, timeline, questions…"><?php echo e(old('message')); ?></textarea>
            </div>
          </div>

          <!-- honeypot (spam trap) -->
          <input class="hp" type="text" name="_gotcha" tabindex="-1" autocomplete="off" aria-hidden="true" />
          <!-- email subject + auto-filled estimate snapshot -->
          <input type="hidden" name="_subject" value="New solar estimate lead — Evergreen" />
          <input type="hidden" name="bill_php" id="hBill" />
          <input type="hidden" name="system_type" id="hType" />
          <input type="hidden" name="system_size_kwp" id="hKwp" />
          <input type="hidden" name="panels" id="hPanels" />
          <input type="hidden" name="target_offset_pct" id="hOffset" />
          <input type="hidden" name="est_cost_php" id="hCost" />
          <input type="hidden" name="est_monthly_savings_php" id="hSave" />

          <div class="lead-actions">
            <button class="btn btn-lime" type="submit">Send my estimate
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </button>
            <span class="lead-msg" id="leadMsg" role="status"></span>
          </div>
        </form>

        <div class="form-done" id="formDone"<?php if(session('lead_success')): ?> style="display:block"<?php endif; ?>>
          <h3>Thanks — we've got it. 🌱</h3>
          <p>Your estimate is on its way to the Evergreen team. We'll be in touch shortly to schedule a site assessment and send your detailed quote. For anything urgent, call <a href="tel:+639663051461" style="color:var(--foliage);font-weight:600;">0966 305 1461</a>.</p>
        </div>
      </div>
    </div>
  </section>
  </main>

  
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
<script src="/assets/page-estimate.js" defer></script>
<?php $__env->stopPush(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH /Users/dahican/Library/CloudStorage/Dropbox/ever-green.ph/resources/views/pages/estimate.blade.php ENDPATH**/ ?>