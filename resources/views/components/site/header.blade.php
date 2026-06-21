@props(['division' => 'group'])
@php($d = config('divisions.'.$division, config('divisions.group')))

  <!-- ===================== NAV ===================== -->
  <header class="nav" id="nav">
    <div class="shell nav-inner">
      <a class="brand" href="/" aria-label="Evergreen home">
        <img src="/assets/logo.png" alt="" />
        <span class="brand-name">
          <b>Evergreen</b>
          @if($d['label'])<span>{{ $d['label'] }}</span>@endif
        </span>
      </a>
      <nav class="nav-links" aria-label="Primary">
        @foreach($d['links'] as [$text, $href])
        <a href="{{ $href }}">{{ $text }}</a>
        @endforeach
      </nav>
      <div class="nav-cta">
        <a class="btn btn-lime" href="{{ $d['cta'][1] }}">{{ $d['cta'][0] }}
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <button class="nav-toggle" id="navToggle" aria-label="Open menu" aria-expanded="false">
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 6h18M3 12h18M3 18h18"/></svg>
        </button>
      </div>
    </div>
  </header>

  <!-- mobile menu -->
  <div class="mobile-menu" id="mobileMenu">
    <div class="mm-top">
      <a class="brand" href="/">
        <img src="/assets/logo.png" alt="" />
        <span class="brand-name"><b>Evergreen</b>@if($d['label'])<span>{{ $d['label'] }}</span>@endif</span>
      </a>
      <button class="mm-close" id="mmClose" aria-label="Close menu">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M6 6l12 12M18 6L6 18"/></svg>
      </button>
    </div>
    <nav>
      @foreach($d['links'] as [$text, $href])
      <a href="{{ $href }}">{{ $text }}</a>
      @endforeach
    </nav>
    <div class="mm-foot">Burgos, Siargao · 0966 305 1461</div>
  </div>
