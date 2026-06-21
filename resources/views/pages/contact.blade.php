@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/division.css') }}">
@endpush

@section('content')
  <main id="top">
  <section class="section">
    <div class="shell">
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Contact</div>
          <h1>Talk to the Evergreen team</h1>
        </div>
        <p class="kicker">Solar, construction, or building materials — reach us directly. We're on-island and happy to help scope your project.</p>
      </div>

      <div class="ec-cards">
        <article class="panel-card reveal">
          <h2>Call or email</h2>
          <p>
            <a href="tel:+639663051461">0966 305 1461</a><br>
            <a href="tel:+639771275822">0977 127 5822</a><br>
            <a href="mailto:simonphconsult@gmail.com">simonphconsult@gmail.com</a>
          </p>
          <a class="btn btn-lime" href="https://api.whatsapp.com/send?phone=639663051461" target="_blank" rel="noopener">Message on WhatsApp
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </article>
        <article class="panel-card reveal">
          <h2>Visit us</h2>
          <p>
            <a href="https://maps.app.goo.gl/td1LZpCJpKA7Vks69" target="_blank" rel="noopener">Burgos, Siargao</a><br>
            Nova Tierra, Davao City
          </p>
        </article>
        <article class="panel-card reveal">
          <h2>Get a solar estimate</h2>
          <p>Size your system, cost, and savings in 30 seconds, then request a detailed quote.</p>
          <a class="btn btn-ghost" href="/solar/estimate">Solar estimator
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
        </article>
      </div>
    </div>
  </section>
  </main>
@endsection
