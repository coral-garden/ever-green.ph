@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="/assets/page-about.css">
@endpush

@section('content')
@verbatim
  <main id="top">
  <!-- ===================== HERO ===================== -->
  <section class="page-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">About us</div>
      <h1>We build for energy independence</h1>
      <p class="hero-sub">Premium, high-performance solar for Siargao — shaped by over 12 years of experience powering homes and businesses across the island.</p>
    </div>
  </section>

  <!-- ===================== INTRO ===================== -->
  <section class="section about-sec">
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
      <div class="about-intro">
        <div class="reveal">
          <div class="tag tag-dot">About Evergreen Solar</div>
          <h2>Precision, reliability, results that last</h2>
          <div class="body">
            <p>Evergreen Solar provides premium, high-performance solar solutions shaped by over 12 years of experience. We power homes, businesses, and essential facilities across Siargao — from General Luna to Dapa and beyond — with work defined by precision, reliability, and results that stand the test of time.</p>
            <p>Every system we create is carefully engineered to be efficient, scalable, and future-ready — featuring advanced hybrid inverters, high-efficiency panels, and flexible battery storage. Whether you're looking to lower energy costs or ensure uninterrupted power, we deliver solar solutions designed to grow with you: elegantly, reliably, and without compromise.</p>
          </div>
        </div>
        <figure class="about-figure reveal">
          <img src="/assets/project-hillside.webp" alt="An Evergreen Solar installation on a Philippine hillside" />
        </figure>
      </div>

      <div class="about-stats reveal">
        <div><div class="k">12+ yrs</div><div class="d">Experience</div></div>
        <div><div class="k">All of Siargao</div><div class="d">Coast to inland</div></div>
        <div><div class="k">3 system types</div><div class="d">Grid-tied · Off-grid · Hybrid</div></div>
        <div><div class="k">Future-ready</div><div class="d">Efficient &amp; scalable</div></div>
      </div>
    </div>
  </section>

  <!-- ===================== WHY ===================== -->
  <section class="section why-band">
    <div class="seam" aria-hidden="true">
      <svg class="seam-fill" viewBox="0 0 1440 90" preserveAspectRatio="none">
        <path d="M0 90 L0 52 C360 4 1080 4 1440 52 L1440 90 Z" fill="var(--foliage)"/>
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
    <div class="shell reveal">
      <div class="tag tag-dot">Why we do what we do</div>
      <h2>We build for people</h2>
      <div class="body">
        <p>Dependable energy should feel effortless, not uncertain. In Siargao, where power interruptions are part of island life, reliable electricity brings more than convenience — it brings comfort, security, and peace of mind.</p>
        <p>Our purpose is to make solar feel simple, seamless, and truly dependable. We focus on thoughtful design, honest guidance, and long-term performance — so every system we deliver is not just an upgrade, but a lasting investment in a better way of living.</p>
      </div>
    </div>
  </section>

  <!-- ===================== CTA ===================== -->
  <section class="section cta-band">
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
          <path d="M33 23 C42 17 50 19 56 28"/>
        </g>
      </svg>
    </div>
    <div class="shell">
      <div class="reveal">
        <div class="tag tag-dot">Ready when you are</div>
        <h2>Get an estimate for your upcoming project</h2>
        <p>Size your system and savings in 30 seconds, or talk it through with our island-based team.</p>
        <div class="cta-actions">
          <a class="btn btn-lime" href="/estimate">Get a quote
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a class="btn btn-ghost-light" href="/#contact">Talk to our team</a>
        </div>
      </div>
    </div>
  </section>
  </main>

  
@endverbatim
@endsection
