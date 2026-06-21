@extends('layouts.app')

@push('head')
@include('partials.jsonld-home')
@endpush

@section('content')
@verbatim
  <!-- ===================== HERO ===================== -->
  <main id="top">
  <section class="hero">
    <!-- sun-path arc: the diagram an installer uses to plan panel orientation -->
    <svg class="sunpath" viewBox="0 0 1200 700" preserveAspectRatio="xMidYMid slice" aria-hidden="true">
      <path class="arc" d="M -40 600 Q 600 -120 1240 600" />
      <path class="arc-lit" id="arcLit" d="M -40 600 Q 600 -120 1240 600" pathLength="100" stroke-dasharray="100" stroke-dashoffset="50" />
      <!-- hour ticks -->
      <g>
        <line class="htick" x1="170" y1="352" x2="170" y2="372"/><text x="158" y="392">06</text>
        <line class="htick" x1="600" y1="138" x2="600" y2="158"/><text x="588" y="128">12</text>
        <line class="htick" x1="1030" y1="352" x2="1030" y2="372"/><text x="1018" y="392">18</text>
      </g>
      <circle class="sun-dot" id="sunDot" r="9" cx="600" cy="142" />
    </svg>

    <div class="shell hero-grid">
      <div class="hero-copy">
        <div class="tag tag-dot hero-eyebrow reveal">Solar for island living</div>
        <h1 class="reveal">Powering<span class="l2">Siargao</span></h1>
        <p class="hero-sub reveal">High-performance solar systems engineered for reliability, long-term savings, and dependable energy — built for life on the island.</p>
        <div class="hero-actions reveal">
          <a class="btn btn-lime" href="/estimate">Get a quote
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a class="btn btn-ghost-light" href="#systems">See our systems</a>
        </div>
      </div>

      <div class="hero-photo reveal">
        <div class="frame">
          <span class="tick tl"></span><span class="tick br"></span>
          <img src="/assets/hero-aframe.webp" alt="Solar panels mounted on a thatched A-frame bungalow on a Philippine island" />
          <div class="cap"><b>Off-grid A-frame</b><span>Siargao · Hybrid system</span></div>
        </div>
      </div>
    </div>

    <!-- readout strip: truthful, categorical — no invented metrics -->
    <div class="shell readout reveal">
      <div class="r"><div class="k">System types</div><div class="v">Grid-tied · Off-grid · Hybrid</div><div class="d">Sized to your load and roof</div></div>
      <div class="r"><div class="k">Built for</div><div class="v">Outage-prone islands</div><div class="d">Reliable power when the grid drops</div></div>
      <div class="r"><div class="k">Coverage</div><div class="v">General Luna · Dapa · Burgos</div><div class="d">Island-wide, on-site Siargao crews</div></div>
      <div class="r"><div class="k">What you get</div><div class="v">Top-tier panels + expert install</div><div class="d">Simple. Reliable. Sustainable.</div></div>
    </div>
  </section>

  <!-- ===================== SERVICES ===================== -->
  <section class="section" id="systems">
    <!-- curved island-horizon seam -->
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--paper)"/>
        <path d="M0 52 C360 4 1080 4 1440 52" fill="none" stroke="var(--lime)" stroke-width="2" stroke-dasharray="6 8" opacity=".55" vector-effect="non-scaling-stroke"/>
      </svg>
      <svg class="seam-badge" viewBox="0 0 64 64" aria-hidden="true">
        <circle cx="32" cy="32" r="29" fill="var(--lime)"/>
        <g transform="translate(32,32) scale(0.58) translate(-32,-32)" fill="none" stroke="var(--panel)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="32" cy="32" r="11" fill="var(--panel)" stroke="none"/>
          <path d="M32 10V3M32 61v-7M54 32h7M3 32h7M47 17l5-5M12 52l5-5M47 47l5 5M12 12l5 5"/>        </g>
      </svg>
    </div>
    <div class="shell">
      <div class="section-head section-head--systems reveal">
        <div class="lead">
          <div class="tag tag-dot">Our services</div>
          <h2>Three systems,<br>one for every roof</h2>
          <p class="kicker">From beachfront resorts on the grid to off-grid villas down a dirt road — we match the right setup to your roof, your load, and how often the power cuts out.</p>
        </div>

        <!-- rooftop array under the sun-path arc: pictures "one for every roof" -->
        <figure class="roof-art" role="img" aria-label="A rooftop solar array soaking up the sun">
          <svg viewBox="0 0 400 300" fill="none" xmlns="http://www.w3.org/2000/svg">
            <!-- sun-path arc echo -->
            <path d="M28 214 Q200 46 372 214" stroke="var(--foliage)" stroke-width="1.5" stroke-dasharray="4 7" opacity=".45"/>
            <!-- sun -->
            <g class="ra-sun">
              <circle class="ra-glow" cx="300" cy="96" r="38" fill="var(--lime)" opacity=".18"/>
              <circle cx="300" cy="96" r="22" fill="var(--lime)"/>
              <g stroke="var(--lime)" stroke-width="2.4" stroke-linecap="round">
                <path d="M300 60v-12M300 144v12M336 96h12M252 96h-12M327 69l8-8M265 131l-8 8M327 123l8 8M265 61l-8-8"/>
              </g>
            </g>
            <!-- ground -->
            <line x1="44" y1="250" x2="356" y2="250" stroke="var(--foliage)" stroke-width="1.5" opacity=".5"/>
            <!-- house body -->
            <rect x="128" y="178" width="120" height="68" rx="3" fill="var(--paper-2)" stroke="var(--foliage)" stroke-width="2"/>
            <rect x="150" y="206" width="26" height="40" rx="1.5" fill="none" stroke="var(--foliage)" stroke-width="1.6"/>
            <rect x="200" y="206" width="30" height="22" rx="1.5" fill="none" stroke="var(--foliage)" stroke-width="1.6"/>
            <!-- roof = solar array (parallelogram), grid of panels -->
            <path d="M150 150 L270 150 L248 178 L128 178 Z" fill="var(--lime)" fill-opacity=".22" stroke="var(--foliage)" stroke-width="2" stroke-linejoin="round"/>
            <g stroke="var(--foliage)" stroke-width="1.4" opacity=".75">
              <line x1="180" y1="150" x2="158" y2="178"/>
              <line x1="210" y1="150" x2="188" y2="178"/>
              <line x1="240" y1="150" x2="218" y2="178"/>
              <line x1="139" y1="164" x2="259" y2="164"/>
            </g>
            <!-- energy tick from roof to a small inverter -->
            <path d="M188 164 q-46 6-58 28" stroke="var(--lime-deep)" stroke-width="1.6" stroke-dasharray="3 4"/>
            <circle cx="130" cy="192" r="3.5" fill="var(--lime-deep)"/>
          </svg>
        </figure>
      </div>

      <div class="systems">
        <article class="sys reveal">
          <span class="sys-glow"></span>
          <div class="sys-no">01 / TIED</div>
          <svg class="sys-ico" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="6" y="10" width="36" height="20" rx="2"/><path d="M6 17h36M6 24h36M16 10v20M26 10v20M24 30v8M16 38h16"/>
          </svg>
          <h3>Grid-Tied Solar System</h3>
          <div class="for">Best for</div>
          <p class="desc">Warehouses, malls, and suburban homes that want to cut bills while staying connected to the utility.</p>
        </article>

        <article class="sys reveal">
          <span class="sys-glow"></span>
          <div class="sys-no">02 / OFF</div>
          <svg class="sys-ico" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M24 4v6M24 38v6M6 24h6M36 24h6"/><circle cx="24" cy="24" r="9"/><rect x="19" y="40" width="10" height="4" rx="1"/>
          </svg>
          <h3>Off-Grid Solar System</h3>
          <div class="for">Best for</div>
          <p class="desc">Remote cabins, farms, and mountain resorts with no reliable line in — fully self-powered, day and night.</p>
        </article>

        <article class="sys reveal">
          <span class="sys-glow"></span>
          <div class="sys-no">03 / HYBRID</div>
          <svg class="sys-ico" viewBox="0 0 48 48" fill="none" stroke="currentColor" stroke-width="2.2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="8" y="14" width="20" height="26" rx="2"/><path d="M8 22h20M18 14v26"/><path d="M30 20l8-8M38 12v7M38 12h-7M30 32l8 8M38 40v-7M38 40h-7"/>
          </svg>
          <h3>Hybrid Solar System</h3>
          <div class="for">Best for</div>
          <p class="desc">Hospitals, data centers, and outage-prone areas that need battery backup the moment the grid blinks.</p>
        </article>
      </div>
    </div>
  </section>

  <!-- ===================== ABOUT ===================== -->
  <section class="section about" id="about">
    <!-- curved island-horizon seam -->
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--foliage)"/>
        <path d="M0 52 C360 4 1080 4 1440 52" fill="none" stroke="var(--lime)" stroke-width="2" stroke-dasharray="6 8" opacity=".55" vector-effect="non-scaling-stroke"/>
      </svg>
      <svg class="seam-badge" viewBox="0 0 64 64" aria-hidden="true">
        <circle cx="32" cy="32" r="29" fill="var(--lime)"/>
        <g transform="translate(32,32) scale(0.58) translate(-32,-32)" fill="none" stroke="var(--panel)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M10 31 L40 18 L56 28 L26 41 Z"/>
          <path d="M20.7 26.3 L36.7 36.6"/>
          <path d="M30.3 22.1 L46.3 32.4"/>
          <path d="M18 36 L48 23"/>
          <path d="M33 39 L30 56 M45 33 L49 56 M27 56 L53 56"/>        </g>
      </svg>
    </div>
    <div class="shell about-grid">
      <div class="about-copy-wrap reveal">
        <div class="tag tag-dot">About Evergreen Solar</div>
        <h2>We bring the power of the sun to your doorstep</h2>
        <div class="about-copy">
          <p>At Evergreen Solar, we deliver top-tier, professional-grade solar — only the best solar sets, backed by expert service and cutting-edge technology.</p>
          <p>We engineer every system around how you actually live and work, so clean energy stays dependable long after the install.</p>
          <p class="promise">We're here to make clean energy simple, smart, and seamless.</p>
        </div>
        <div class="about-actions">
          <a class="btn btn-lime" href="#contact">Talk to our team
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <div class="about-photo reveal">
        <img src="/assets/project-hillside.webp" alt="Evergreen Solar crew installing a panel array on a green island hillside" />
        <div class="badge"><b>On-island crews</b> · install, service &amp; support</div>
      </div>
    </div>
  </section>

  <!-- ===================== PROJECTS ===================== -->
  <section class="section" id="projects">
    <!-- curved island-horizon seam -->
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--paper)"/>
        <path d="M0 52 C360 4 1080 4 1440 52" fill="none" stroke="var(--lime)" stroke-width="2" stroke-dasharray="6 8" opacity=".55" vector-effect="non-scaling-stroke"/>
      </svg>
      <svg class="seam-badge" viewBox="0 0 64 64" aria-hidden="true">
        <circle cx="32" cy="32" r="29" fill="var(--lime)"/>
        <g transform="translate(32,32) scale(0.58) translate(-32,-32)" fill="none" stroke="var(--panel)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M20 54 V34 H46 V54"/>
          <path d="M15 34 L33 19 L51 34"/>
          <path d="M35 23 L49 31 L45 34 L33 27 Z"/>
          <path d="M28 54 V43 H37 V54"/>        </g>
      </svg>
    </div>
    <div class="shell">
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Recent projects</div>
          <h2>Powering real island life</h2>
        </div>
        <p class="kicker">Discover our latest installs across coastal towns, hillsides, and off-grid getaways.</p>
      </div>

      <div class="proj-grid">
        <a class="proj big reveal" href="#contact">
          <img src="/assets/hero-aframe.webp" alt="Solar array on a thatched A-frame bungalow" />
          <div class="meta"><div class="loc">Siargao · Off-grid</div><div class="ttl">A-frame beach house</div></div>
        </a>
        <a class="proj small reveal" href="#contact">
          <img src="/assets/project-coastal-roof.webp" alt="Solar panels on a coastal town rooftop" />
          <div class="meta"><div class="loc">Dapa, Siargao · Grid-tied</div><div class="ttl">Seaside rooftop</div></div>
        </a>
        <a class="proj small reveal" href="#contact">
          <img src="/assets/project-palms.webp" alt="Rooftop solar panels among coconut palms" />
          <div class="meta"><div class="loc">General Luna, Siargao · Hybrid</div><div class="ttl">Among the palms</div></div>
        </a>
        <a class="proj small reveal" href="#contact">
          <img src="/assets/project-hillside.webp" alt="Crew installing a solar array on a green island hillside" />
          <div class="meta"><div class="loc">Burgos, Siargao · Off-grid</div><div class="ttl">Hillside array</div></div>
        </a>
      </div>

      <div style="margin-top:36px;" class="reveal">
        <a class="btn btn-ghost" href="#contact">More projects
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
      </div>
    </div>
  </section>

  <!-- ===================== QUOTE / CONTACT ===================== -->
  <section class="section quote" id="contact">
    <!-- curved island-horizon seam -->
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--panel)"/>
        <path d="M0 52 C360 4 1080 4 1440 52" fill="none" stroke="var(--lime)" stroke-width="2" stroke-dasharray="6 8" opacity=".55" vector-effect="non-scaling-stroke"/>
      </svg>
      <svg class="seam-badge" viewBox="0 0 64 64" aria-hidden="true">
        <circle cx="32" cy="32" r="29" fill="var(--lime)"/>
        <g transform="translate(32,32) scale(0.58) translate(-32,-32)" fill="none" stroke="var(--panel)" stroke-width="3.4" stroke-linecap="round" stroke-linejoin="round">
          <path d="M12 55 Q32 47 52 55"/>
          <path d="M35 55 C33 43 39 33 33 23"/>
          <path d="M33 23 C24 19 17 21 11 29"/>
          <path d="M33 23 C26 13 19 10 11 11"/>
          <path d="M33 23 C33 13 33 9 32 4"/>
          <path d="M33 23 C43 13 52 11 60 16"/>
          <path d="M33 23 C42 17 50 19 56 28"/>        </g>
      </svg>
    </div>
    <div class="shell quote-inner">
      <div class="reveal">
        <div class="tag tag-dot">Get a quote</div>
        <h2>Let's plan your upcoming project</h2>
        <div class="quote-actions">
          <a class="btn btn-lime" href="/estimate">Get a quote
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </div>
      </div>
      <div class="contacts reveal">
        <a href="tel:+639663051461">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5-3 2a14 14 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2A17 17 0 0 1 3 6a2 2 0 0 1 2-2"/></svg>
          0966 305 1461
        </a>
        <a href="tel:+639771275822">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 4h4l2 5-3 2a14 14 0 0 0 6 6l2-3 5 2v4a2 2 0 0 1-2 2A17 17 0 0 1 3 6a2 2 0 0 1 2-2"/></svg>
          0977 127 5822
        </a>
        <a href="mailto:simonphconsult@gmail.com">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><rect x="3" y="5" width="18" height="14" rx="2"/><path d="m3 7 9 6 9-6"/></svg>
          simonphconsult@gmail.com
        </a>
        <span>
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M12 21s-7-5.5-7-11a7 7 0 0 1 14 0c0 5.5-7 11-7 11Z"/><circle cx="12" cy="10" r="2.5"/></svg>
          Burgos, Siargao · Nova Tierra, Davao City
        </span>
      </div>
    </div>
  </section>
  </main>

  
@endverbatim
@endsection

@push('scripts')
<script src="/assets/page-home.js" defer></script>
@endpush
