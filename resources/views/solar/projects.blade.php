@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/page-projects.css') }}">
@endpush

@section('content')
@verbatim
  <main id="top">
  <!-- ===================== HERO ===================== -->
  <section class="page-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Our work</div>
      <h1>We build projects that last</h1>
      <p class="hero-sub">A look at solar installs across the islands — homestays, villas, and hostels running cleaner, quieter, and through the brownouts. Tap any photo to view it full size.</p>
    </div>
  </section>

  <!-- ===================== GALLERY ===================== -->
  <section class="section gallery-sec">
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
      <div class="section-head reveal">
        <div class="lead">
          <div class="tag tag-dot">Selected installs</div>
          <h2>Powered by sun, across Siargao</h2>
        </div>
        <p class="kicker">Real homes and businesses we've taken solar — each one engineered for the island's salt air, sun, and storms.</p>
      </div>

      @endverbatim

      @php
        $specProjects = collect($projects)->filter(fn ($p) => ! empty($p['specs']));
        $extras = collect($projects)->filter(fn ($p) => empty($p['specs']));
      @endphp

      <div class="proj-rows">
        @foreach ($specProjects as $p)
          @php
            $all = collect($p['photos'])->map(fn ($f) => '/assets/projects/'.$f)->values();
            $roof = '/assets/projects/'.$p['photos'][0];
            $eq = '/assets/projects/'.$p['equipment'];
            $roofList = $all->implode(',');
            $eqList = collect([$eq])->merge($all->reject(fn ($u) => $u === $eq))->implode(',');
          @endphp
          <article class="proj-row reveal">
            <div class="proj-row-head">
              <div class="ploc">{{ $p['location'] }}</div>
              <h3 class="ptitle">{{ $p['title'] }}</h3>
              <ul class="pspecs">
                @foreach ($p['specs'] as $spec)
                  <li>{{ $spec }}</li>
                @endforeach
              </ul>
            </div>
            <div class="proj-pair">
              <button class="pcard reveal" data-title="{{ $p['title'] }}" data-loc="{{ $p['location'] }}" data-photos="{{ $roofList }}">
                <img src="{{ $roof }}" alt="Rooftop solar array at {{ $p['title'] }}, {{ $p['location'] }}" loading="lazy" />
                <span class="pcard-tag">Rooftop array</span>
              </button>
              <button class="pcard reveal" data-title="{{ $p['title'] }}" data-loc="{{ $p['location'] }}" data-photos="{{ $eqList }}">
                <img src="{{ $eq }}" alt="Inverter and battery system at {{ $p['title'] }}, {{ $p['location'] }}" loading="lazy" />
                <span class="pcard-tag">Inverter &amp; battery</span>
              </button>
            </div>
          </article>
        @endforeach
      </div>

      @if ($extras->isNotEmpty())
        <div class="proj-extras-head reveal">
          <div class="tag tag-dot">More installs</div>
        </div>
        <div class="proj-extras">
          @foreach ($extras as $p)
            @php $photoUrls = collect($p['photos'])->map(fn ($f) => '/assets/projects/'.$f)->implode(','); @endphp
            <button class="pcard reveal" data-title="{{ $p['title'] }}" data-loc="{{ $p['location'] }}" data-photos="{{ $photoUrls }}">
              <img src="/assets/projects/{{ $p['photos'][0] }}" alt="Solar installation at {{ $p['title'] }}, {{ $p['location'] }}" loading="lazy" />
              <div class="pmeta">
                <div class="ploc">{{ $p['location'] }}</div>
                <div class="ptitle">{{ $p['title'] }}</div>
              </div>
            </button>
          @endforeach
        </div>
      @endif

      @verbatim
    </div>
  </section>

      @endverbatim
      <!-- ===================== TESTIMONIALS ===================== -->
      <section class="section testimonials">
        <div class="shell">
          <div class="section-head reveal">
            <div class="lead">
              <div class="tag tag-dot">What clients say</div>
              <h2>Trusted across the island</h2>
            </div>
            <p class="kicker">Real words from homeowners and businesses now running on Evergreen solar.</p>
          </div>
          <div class="tgrid">
            @foreach ($testimonials as $t)
              <figure class="tcard reveal">
                <div class="tstars" aria-label="{{ $t['stars'] }} out of 5 stars">{!! str_repeat('★', $t['stars']) !!}</div>
                <blockquote>{{ $t['quote'] }}</blockquote>
                <figcaption class="tname">{{ $t['name'] }}</figcaption>
              </figure>
            @endforeach
          </div>
        </div>
      </section>
      @verbatim

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
        <div class="tag tag-dot">Your roof next</div>
        <h2>Get an estimate for your upcoming project</h2>
        <p>Size your system and savings in 30 seconds, or talk it through with our island-based team.</p>
        <div class="cta-actions">
          <a class="btn btn-lime" href="/solar/estimate">Get a quote
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
          </a>
          <a class="btn btn-ghost-light" href="/contact">Talk to our team</a>
        </div>
      </div>
    </div>
  </section>
  </main>

  <!-- lightbox -->
  <div class="lightbox" id="lightbox" aria-hidden="true" role="dialog" aria-label="Project photo">
    <button class="lb-close" id="lbClose" aria-label="Close">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
    </button>
    <button class="lb-nav lb-prev" id="lbPrev" aria-label="Previous photo">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M15 6l-6 6 6 6"/></svg>
    </button>
    <button class="lb-nav lb-next" id="lbNext" aria-label="Next photo">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M9 6l6 6-6 6"/></svg>
    </button>
    <img id="lbImg" src="" alt="" />
    <div class="lb-cap" id="lbCap"></div>
  </div>

  
@endverbatim
@endsection

@push('scripts')
<script src="{{ assetv('assets/page-projects.js') }}" defer></script>
@endpush
