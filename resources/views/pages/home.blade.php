@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/division.css') }}">
@include('partials.jsonld-home')
@endpush

@section('content')
  <main id="top">
  <section class="section">
    <div class="shell">
      <div class="ec-hero">
        <div class="ec-hero-copy reveal">
          <div class="tag tag-dot">Evergreen · Siargao</div>
          <h1>Powered &amp; built for island living</h1>
          <p class="kicker">Evergreen is an island group of businesses — solar power, steel-frame construction, and building materials — engineered for the salt air, sun, and storms of Siargao. One trusted local team, from foundation to flip-the-switch.</p>
          <div class="ec-hero-actions">
            <a class="btn btn-lime" href="/contact">Talk to our team
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
            </a>
            <a class="btn btn-ghost" href="/about">About Evergreen</a>
          </div>
        </div>
        <div class="hero-photo ec-hero-photo reveal">
          <div class="frame">
            <img src="/assets/construction-frame.webp" alt="A steel-frame house under construction on a palm-fringed Siargao lot" />
            <div class="cap"><b>Evergreen</b><span>Siargao · Davao</span></div>
          </div>
        </div>
      </div>

      <div class="ec-cards ec-cards--links">
        <a class="panel-card ec-card-link reveal" href="/solar">
          <h2>Evergreen Solar <span class="ec-arrow" aria-hidden="true">→</span></h2>
          <p>Grid-tied, off-grid, and hybrid solar systems engineered for reliable island power and long-term savings.</p>
        </a>
        <a class="panel-card ec-card-link reveal" href="/construction">
          <h2>Frame Construction <span class="ec-arrow" aria-hidden="true">→</span></h2>
          <p>Durable, termite-proof light-gauge steel-frame building for homes, resorts, and commercial projects.</p>
        </a>
        <a class="panel-card ec-card-link reveal" href="/hardware">
          <h2>Hardware Supply <span class="ec-arrow" aria-hidden="true">→</span></h2>
          <p>Building materials in stock for island builds — cement board, plywood, flooring and more. Pickup in Burgos.</p>
        </a>
      </div>
    </div>
  </section>
  </main>
@endsection
