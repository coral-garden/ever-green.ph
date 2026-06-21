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
          <div class="tag tag-dot">Frame Construction</div>
          <h1>Building materials price list</h1>
          <p class="kicker">Quality materials for island builds, in stock for pickup in {{ $pickup }}. Contact us for project quotes and bulk pricing.</p>
        </div>
      </div>

      <div class="ec-pricelist reveal">
        <table class="ec-table">
          <thead>
            <tr>
              <th scope="col">Item</th>
              <th scope="col">Thickness</th>
              <th scope="col" class="ec-price">Price</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($materials as $m)
            <tr>
              <td>{{ $m['item'] }}</td>
              <td>{{ $m['thickness'] ?? '—' }}</td>
              <td class="ec-price">₱{{ number_format($m['price']) }}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <p class="ec-note">* Prices are subject to change without prior notice. Pickup location: {{ $pickup }}.</p>
      </div>

      <div class="ec-cta reveal">
        <h2>Planning a build?</h2>
        <a class="btn btn-lime" href="tel:+639663051461">Contact us for a quote
          <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.4" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14M13 6l6 6-6 6"/></svg>
        </a>
        <a class="btn btn-ghost" href="/construction">Back to Frame Construction</a>
      </div>
    </div>
  </section>
  </main>
@endsection
