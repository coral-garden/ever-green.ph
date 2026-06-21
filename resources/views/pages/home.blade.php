@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/division.css') }}">
@include('partials.jsonld-home')
@endpush

@section('content')
  <main id="top">
  <section class="section ec-portal">
    <div class="shell">
      <a class="portal-box reveal" href="/solar">
        <img class="portal-logo" src="/assets/logo.png" alt="" />
        <span class="portal-text"><b>Evergreen</b> Solar</span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      <a class="portal-box reveal" href="/construction">
        <img class="portal-logo" src="/assets/logo.png" alt="" />
        <span class="portal-text"><b>Evergreen</b> Frame Construction</span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
      <a class="portal-box reveal" href="/hardware">
        <img class="portal-logo" src="/assets/logo.png" alt="" />
        <span class="portal-text"><b>Evergreen</b> Hardware Supply</span>
        <svg class="portal-arrow" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
      </a>
    </div>
  </section>
  </main>
@endsection
