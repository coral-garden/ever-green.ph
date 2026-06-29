@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/division.css') }}">
@include('partials.jsonld-home')
@endpush

@section('content')
  <main id="top">
  <section class="section ec-portal">
    <div class="shell">
      <div class="ec-portal-intro reveal">
        <div class="brand-row">
          <img class="ec-portal-mark" src="/assets/logo.png" alt="" />
          <div class="tag tag-dot">Island group</div>
        </div>
        <h1>We power &amp; build island living</h1>
        <p class="kicker">Evergreen is an island group — solar power, steel-frame construction, and building materials — shaped by over 12 years of experience powering and building across Siargao.</p>
      </div>

      <a class="portal-box reveal" href="/solar">
        <span class="portal-ico" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><circle cx="12" cy="12" r="3.6"/><path d="M12 2v2.4M12 19.6V22M2 12h2.4M19.6 12H22M5 5l1.7 1.7M17.3 17.3 19 19M19 5l-1.7 1.7M6.7 17.3 5 19"/></svg>
        </span>
        <span class="portal-body">
          <span class="portal-text"><b>Evergreen</b> Solar</span>
          <span class="portal-desc">High-performance solar systems engineered for reliability, long-term savings, and dependable energy.</span>
        </span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>

      <a class="portal-box reveal" href="/construction">
        <span class="portal-ico" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M3 21h18M5 21V10l7-5 7 5v11M9 21v-5h6v5M8.5 10.5h7M8.5 14h7"/></svg>
        </span>
        <span class="portal-body">
          <span class="portal-text"><b>Evergreen</b> Frame Construction</span>
          <span class="portal-desc">Light-gauge steel-frame construction engineered for island living — fast, durable, termite-proof builds.</span>
        </span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>

      <a class="portal-box reveal" href="/hardware">
        <span class="portal-ico" aria-hidden="true">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.9" stroke-linecap="round" stroke-linejoin="round"><path d="M12 2.5 21 7.5 12 12.5 3 7.5 12 2.5Z"/><path d="M3 12l9 5 9-5M3 16.5l9 5 9-5"/></svg>
        </span>
        <span class="portal-body">
          <span class="portal-text"><b>Evergreen</b> Hardware Supply</span>
          <span class="portal-desc">Building materials for island builds — cement board, marine plywood, phenolic board, SPC flooring and more.</span>
        </span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </section>
  </main>
@endsection
