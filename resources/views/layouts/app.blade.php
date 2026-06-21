<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<meta name="csrf-token" content="{{ csrf_token() }}" />
<title>{{ $meta['title'] }}</title>
<meta name="description" content="{{ $meta['description'] }}" />
<meta property="og:type" content="website" />
<meta property="og:site_name" content="Evergreen Solar" />
<meta property="og:locale" content="en_PH" />
<meta property="og:title" content="{{ $meta['og_title'] }}" />
<meta property="og:description" content="{{ $meta['og_description'] }}" />
<meta property="og:url" content="{{ $meta['og_url'] }}" />
<meta property="og:image" content="https://www.ever-green.ph/assets/og-cover.png" />
<meta property="og:image:width" content="1200" />
<meta property="og:image:height" content="630" />
<meta property="og:image:alt" content="Evergreen Solar — solar for island living" />
<meta name="twitter:card" content="summary_large_image" />
<meta name="twitter:title" content="{{ $meta['twitter_title'] }}" />
<meta name="twitter:description" content="{{ $meta['twitter_description'] }}" />
<meta name="twitter:image" content="https://www.ever-green.ph/assets/og-cover.png" />

<link rel="canonical" href="{{ $meta['canonical'] }}" />
<meta name="theme-color" content="#07190F" />

<link rel="icon" type="image/png" href="/assets/favicon.png" />
<link rel="apple-touch-icon" href="/assets/logo.png" />

<link rel="preconnect" href="https://fonts.googleapis.com" />
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
<link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&family=Azeret+Mono:wght@400;500;600&family=Noto+Sans:wght@700;800&display=swap" rel="stylesheet" media="print" onload="this.media='all'" />
    <noscript><link href="https://fonts.googleapis.com/css2?family=Bricolage+Grotesque:opsz,wght@12..96,500;12..96,700;12..96,800&family=Hanken+Grotesk:wght@400;500;600;700&family=Azeret+Mono:wght@400;500;600&family=Noto+Sans:wght@700;800&display=swap" rel="stylesheet" /></noscript>

<link rel="stylesheet" href="{{ assetv('assets/site.css') }}" />
@stack('head')
</head>
<body>

  <x-site.header :division="$division ?? 'group'" />

@yield('content')

  <x-site.footer :division="$division ?? 'group'" />

<script src="{{ assetv('assets/site.js') }}" defer></script>
@stack('scripts')
</body>
</html>
