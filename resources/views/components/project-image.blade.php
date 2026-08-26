@props([
    'file',
    'alt',
    'sizes' => '100vw',
    'loading' => null,
    'fetchpriority' => null,
])

@php
    $image = config('project-images')[$file] ?? null;

    if ($image === null) {
        throw new RuntimeException("Missing project image metadata for {$file}");
    }

    $stem = pathinfo($file, PATHINFO_FILENAME);
    $sources = [];

    foreach ([480, 960] as $candidateWidth) {
        if ($image['width'] > $candidateWidth) {
            $sources[] = "/assets/projects/responsive/{$stem}-{$candidateWidth}.webp {$candidateWidth}w";
        }
    }

    $sources[] = "/assets/projects/{$file} {$image['width']}w";
@endphp

<img
  {{ $attributes }}
  src="/assets/projects/{{ $file }}"
  srcset="{{ implode(', ', $sources) }}"
  sizes="{{ $sizes }}"
  width="{{ $image['width'] }}"
  height="{{ $image['height'] }}"
  alt="{{ $alt }}"
  decoding="async"
  @if ($loading !== null) loading="{{ $loading }}" @endif
  @if ($fetchpriority !== null) fetchpriority="{{ $fetchpriority }}" @endif
/>
