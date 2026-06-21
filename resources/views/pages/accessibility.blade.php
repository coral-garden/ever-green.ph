@extends('layouts.app')

@section('content')
@verbatim
  <main id="top">
  <section class="page-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Legal</div>
      <h1>Accessibility Statement</h1>
      <p class="hero-sub">We want everyone to be able to learn about going solar — including people with disabilities.</p>
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

        <h2>Our commitment</h2>
        <p>Evergreen Solar is committed to making our website accessible to as many people as possible, regardless of ability or technology. We aim to meet the spirit of the Web Content Accessibility Guidelines (WCAG) 2.1 at Level AA.</p>

        <h2>What we do</h2>
        <ul>
          <li>Semantic, structured HTML so screen readers can navigate the page in a logical order.</li>
          <li>Full keyboard navigation, with a clearly visible focus outline on every interactive element.</li>
          <li>Colour combinations chosen for readable contrast against their backgrounds.</li>
          <li>Descriptive labels on buttons, links, and form fields, with live updates announced where they matter.</li>
          <li>Reduced-motion support — animations are minimised when your device requests it.</li>
          <li>Responsive layouts that work from large desktops down to small phones, and adapt to larger text sizes.</li>
        </ul>

        <h2>Ongoing work</h2>
        <p>Accessibility is never finished. We review the site as we add features and welcome reports of anything that gets in your way.</p>

        <h2>Contact us</h2>
        <p>If you encounter a barrier on this site, or need information in a different format, please email <a href="mailto:simonphconsult@gmail.com">simonphconsult@gmail.com</a> or call <a href="tel:+639663051461">0966 305 1461</a> and we'll help.</p>
      </div>
    </div>
  </section>
  </main>

  
@endverbatim
@endsection
