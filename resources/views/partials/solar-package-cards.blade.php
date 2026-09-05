<div class="package-grid">
  @foreach($packages as $slug => $package)
    <article class="package-card">
      <p class="package-name">{{ $package['name'] }}</p>
      <h3>{{ $package['kva'] }} <span>kVA hybrid</span></h3>
      <p class="package-price">₱{{ number_format($package['price']) }}</p>
      <p class="package-price-label">Advertised package price</p>
      <ul class="package-specs">
        <li><strong>{{ $package['panels'] }} × 630 W</strong> panels</li>
        <li><strong>{{ $package['battery_capacity'] }}</strong> battery storage</li>
        <li>Installation included</li>
      </ul>
      <a class="btn btn-lime package-quote" href="/solar/estimate?package={{ $slug }}#quote" aria-label="Get a quote for {{ $package['name'] }}, {{ $package['kva'] }} kVA hybrid">Get a quote</a>
    </article>
  @endforeach
</div>
