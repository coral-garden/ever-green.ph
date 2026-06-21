@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="/assets/page-construction.css">
@endpush

@section('content')
  <main id="top">
  <section class="section">
    <div class="shell">
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Evergreen Frame Construction</div>
          <h1>Build for island living</h1>
          <p class="kicker">Light-gauge steel-frame construction and quality building materials — engineered for the salt air, sun, and storms of Siargao. From frame to finish, and the materials to match.</p>
        </div>
      </div>

      <div class="ec-cards">
        <article class="panel-card reveal">
          <h2>Steel-frame construction</h2>
          <p>Durable, termite-proof, fast-to-build light-gauge steel framing for homes, resorts, and commercial builds across the island.</p>
        </article>
        <article class="panel-card reveal">
          <h2>Building materials</h2>
          <p>Cement board, marine plywood, phenolic board, rockwool, SPC flooring and more — in stock for pickup in Burgos.</p>
          <a class="btn btn-ghost" href="/construction/materials">View price list
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </article>
        <article class="panel-card reveal">
          <h2>Project quotes</h2>
          <p>Tell us about your build and we'll scope materials and labour. On-island crews, straight answers.</p>
          <a class="btn btn-lime" href="tel:+639663051461">Call for a quote
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </article>
      </div>
    </div>
  </section>
  </main>
@endsection
