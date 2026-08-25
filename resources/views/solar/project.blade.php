@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/page-projects.css') }}">
@endpush

@php
  $photoUrls = collect($project['photos'])->map(fn ($file) => '/assets/projects/'.$file)->values();
  $videoUrls = collect($project['videos'] ?? [])->map(fn ($file) => '/assets/projects/'.$file)->values();
@endphp

@section('content')
<main id="top">
  <section class="page-hero project-page-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell project-hero-grid">
      <div class="project-hero-copy">
        <nav class="project-breadcrumb" aria-label="Breadcrumb">
          <a href="/solar">Solar</a><span aria-hidden="true">/</span>
          <a href="/solar/projects">Projects</a><span aria-hidden="true">/</span>
          <span>{{ $project['title'] }}</span>
        </nav>
        <div class="tag tag-dot">{{ $project['location'] }}</div>
        <h1>{{ $project['title'] }} solar installation</h1>
        <p class="hero-sub">An Evergreen Solar project in {{ $project['location'] }}. Explore the system details and installation gallery below.</p>
        <a class="project-back-link" href="/solar/projects">← All solar projects</a>
      </div>

      <button
        class="pcard project-hero-media"
        type="button"
        data-title="{{ $project['title'] }}"
        data-loc="{{ $project['location'] }}"
        data-photos="{{ $photoUrls->implode(',') }}"
        data-videos="{{ $videoUrls->implode(',') }}"
        data-start="0"
        aria-label="Open {{ $project['title'] }} project gallery"
      >
        <img src="{{ $photoUrls->first() }}" alt="Solar installation at {{ $project['title'] }}, {{ $project['location'] }}" />
        <span class="pcard-tag">View gallery</span>
      </button>
    </div>
  </section>

  <section class="section project-overview">
    <div class="shell project-overview-grid">
      <div class="reveal">
        <div class="tag tag-dot">Project overview</div>
        @if (! empty($project['specs']))
          <h2>Solar system details</h2>
          <ul class="project-specs">
            @foreach ($project['specs'] as $spec)
              <li>{{ $spec }}</li>
            @endforeach
          </ul>
        @else
          <h2>Solar project in {{ $project['location'] }}</h2>
          <p class="project-overview-copy">Browse this Evergreen Solar installation, then talk to our island-based team about a system designed for your property and power needs.</p>
        @endif
      </div>
      <aside class="project-location-card reveal">
        <span>Location</span>
        <strong>{{ $project['location'] }}</strong>
        <a href="/contact">Discuss a similar project →</a>
      </aside>
    </div>
  </section>

  <section class="section project-gallery-section">
    <div class="shell">
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Installation photos</div>
          <h2>Project gallery</h2>
        </div>
        <p class="kicker">Select any image to view the full gallery.</p>
      </div>

      <div class="project-gallery-grid">
        @foreach ($photoUrls as $index => $photoUrl)
          <button
            class="pcard reveal"
            type="button"
            data-title="{{ $project['title'] }}"
            data-loc="{{ $project['location'] }}"
            data-photos="{{ $photoUrls->implode(',') }}"
            data-videos="{{ $videoUrls->implode(',') }}"
            data-start="{{ $index }}"
            aria-label="Open photo {{ $index + 1 }} of {{ $project['title'] }}"
          >
            <img src="{{ $photoUrl }}" alt="{{ $project['title'] }} solar installation in {{ $project['location'] }}, photo {{ $index + 1 }}" loading="lazy" />
            <span class="pcard-tag">Photo {{ $index + 1 }}</span>
          </button>
        @endforeach
      </div>

      @if ($videoUrls->isNotEmpty())
        <div class="project-videos">
          @foreach ($videoUrls as $videoUrl)
            <video controls playsinline preload="metadata" poster="{{ $photoUrls->first() }}" aria-label="{{ $project['title'] }} project video">
              <source src="{{ $videoUrl }}" type="video/mp4" />
            </video>
          @endforeach
        </div>
      @endif
    </div>
  </section>

  <section class="section cta-band project-cta">
    <div class="shell">
      <div class="tag tag-dot">Your project</div>
      <h2>Plan a solar system for your property</h2>
      <p>Start with a quick estimate or talk through your roof, loads, and backup needs with Evergreen Solar.</p>
      <div class="cta-actions">
        <a class="btn btn-lime" href="/solar/estimate">Get a solar estimate</a>
        <a class="btn btn-ghost-light" href="/contact">Talk to our team</a>
      </div>
    </div>
  </section>
</main>

<div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="Project gallery">
  <button class="lb-close" id="lbClose" aria-label="Close gallery">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
  </button>
  <button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous photo">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>
  </button>
  <button class="lb-nav lb-next" id="lbNext" aria-label="Next photo">
    <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>
  </button>
  <img id="lbImg" alt="" hidden />
  <video id="lbVideo" controls playsinline preload="metadata" hidden aria-label="Project video"></video>
  <div class="lb-cap" id="lbCap"></div>
</div>
@endsection

@push('scripts')
<script src="{{ assetv('assets/page-projects.js') }}" defer></script>
@endpush
