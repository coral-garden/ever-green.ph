@extends('layouts.app')

@push('head')
<link rel="stylesheet" href="{{ assetv('assets/page-packages.css') }}">
@endpush

@section('content')
<main id="top">
  <section class="page-hero packages-hero">
    <img class="hero-watermark" src="/assets/logo.png" alt="" aria-hidden="true" />
    <div class="shell">
      <div class="tag tag-dot">Evergreen Solar packages</div>
      <h1>Hybrid solar packages</h1>
      <p class="hero-sub">Compare 3–12 kVA systems with panels, battery storage, and installation included. We'll check your roof and power needs before confirming your quote.</p>
      <a class="btn btn-lime" href="#packages">See packages &amp; prices</a>
    </div>
  </section>

  <section class="section packages-section" id="packages" aria-labelledby="packages-title">
    <div class="shell">
      <div class="section-head">
        <div class="lead">
          <div class="tag tag-dot">Packages &amp; prices</div>
          <h2 id="packages-title">Choose your package</h2>
        </div>
        <p class="kicker">Free quote and site assessment. We'll confirm the equipment, installation scope, and final price for your location.</p>
      </div>
      @include('partials.solar-package-cards')
      <p class="package-note">Package prices as of September 2026. Final scope, delivery, taxes, and any site-specific work are confirmed in your quote.</p>
      <div class="package-inclusions">
        <div>
          <div class="tag tag-dot">Included in every package</div>
          <h3>Installation and setup</h3>
        </div>
        <ul>
          @foreach(config('catalog.solar.inclusions') as $inclusion)
            <li>{{ $inclusion }}</li>
          @endforeach
        </ul>
      </div>
    </div>
  </section>

  <section class="section package-comparison" id="compare" aria-labelledby="comparison-title">
    <div class="shell">
      <div class="section-head">
        <div class="lead">
          <div class="tag tag-dot">Side by side</div>
          <h2 id="comparison-title">Compare the details</h2>
        </div>
        <p class="kicker">kVA is the advertised system rating; kWp is the combined panel rating. Battery capacity is nominal storage, with usable energy depending on the equipment and settings.</p>
      </div>
      <p class="package-scroll-hint" id="comparison-hint">Scroll across the table to compare all five packages.</p>
      <div class="package-table-wrap" role="region" aria-labelledby="comparison-title" aria-describedby="comparison-hint" tabindex="0">
        <table class="package-table">
          <caption class="package-sr-only">Hybrid solar package equipment and advertised warranty comparison</caption>
          <thead>
            <tr>
              <th scope="col">What's included</th>
              @foreach($packages as $package)
                <th scope="col">{{ $package['name'] }}<span>{{ $package['kva'] }} kVA hybrid</span></th>
              @endforeach
            </tr>
          </thead>
          <tbody>
            <tr><th scope="row">Advertised price</th>@foreach($packages as $package)<td class="package-table-price">₱{{ number_format($package['price']) }}</td>@endforeach</tr>
            <tr><th scope="row">Solar panels</th>@foreach($packages as $package)<td>{{ $package['panels'] }} × {{ $package['panel_type'] }}</td>@endforeach</tr>
            <tr><th scope="row">Panel array</th>@foreach($packages as $package)<td>{{ number_format($package['panels'] * 630 / 1000, 2) }} kWp</td>@endforeach</tr>
            <tr><th scope="row">Inverter</th>@foreach($packages as $package)<td>{{ $package['inverter'] }}</td>@endforeach</tr>
            <tr><th scope="row">Battery equipment</th>@foreach($packages as $package)<td>{{ $package['battery'] }}</td>@endforeach</tr>
            <tr><th scope="row">Total battery storage</th>@foreach($packages as $package)<td>{{ $package['battery_capacity'] }}</td>@endforeach</tr>
            <tr><th scope="row">Panel warranty</th>@foreach($packages as $package)<td>{{ $package['panel_warranty'] }}</td>@endforeach</tr>
            <tr><th scope="row">Inverter warranty</th>@foreach($packages as $package)<td>{{ $package['inverter_warranty'] }}</td>@endforeach</tr>
            <tr><th scope="row">Battery warranty</th>@foreach($packages as $package)<td>{{ $package['battery_warranty'] }}</td>@endforeach</tr>
            <tr><th scope="row">Your next step</th>@foreach($packages as $slug => $package)<td><a class="package-text-link" href="/solar/estimate?package={{ $slug }}#quote" aria-label="Enquire about {{ $package['name'] }}">Request a quote →</a></td>@endforeach</tr>
          </tbody>
        </table>
      </div>
      <div class="package-warranty-notes">
        <h3>Warranty details</h3>
        <p>Warranty terms shown are as advertised. Your quote will confirm coverage, conditions, and any cycle limits.</p>
        <ul>
          @foreach($packages as $package)
            @if($package['warranty_note'])
              <li><strong>{{ $package['name'] }}:</strong> {{ $package['warranty_note'] }}</li>
            @endif
          @endforeach
        </ul>
      </div>
      <div class="package-help">
        <h3>Need help choosing?</h3>
        <p>Tell us about your electricity bill and backup needs. We'll help you find a suitable system.</p>
        <a class="btn btn-lime" href="/solar/estimate">Estimate my needs</a>
      </div>
    </div>
  </section>
</main>
@endsection
