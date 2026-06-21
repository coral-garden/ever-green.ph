@extends('layouts.app')

@section('content')
@verbatim
  <main id="top">
  <section class="page-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Legal</div>
      <h1>Privacy Policy</h1>
      <p class="hero-sub">We treat your personal information with the same precision and care we apply to our electrical engineering projects.</p>
    </div>
  </section>

  <section class="section prose-sec">
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
      <div class="prose reveal">
        <p class="meta">Evergreen Solar Solutions · Philippines</p>

        <h2>Our commitment to your privacy</h2>
        <p>At Evergreen Solar Solutions, we treat your personal information with the same precision and care we apply to our electrical engineering projects. We collect the essential details needed to design solar systems, including contact information, installation addresses in Siargao or Dinagat, and energy-consumption data.</p>

        <h2>How we use and protect your information</h2>
        <p>Information is used exclusively for creating engineering proposals, scheduling site surveys, and coordinating with local utility cooperatives for net-metering. We do not sell, trade, or share your data with outside marketers. We maintain security through encrypted communication and secure data storage.</p>

        <h2>Your rights and control</h2>
        <p>In accordance with the Philippine Data Privacy Act, you may contact us at any time to review the information we have on file, request corrections, or ask for your data to be removed.</p>

        <p>To exercise any of these rights, email <a href="mailto:simonphconsult@gmail.com">simonphconsult@gmail.com</a> or call <a href="tel:+639663051461">0966 305 1461</a>.</p>
      </div>
    </div>
  </section>
  </main>

  
@endverbatim
@endsection
