@php($label = config('divisions.'.($division ?? 'group').'.label'))
<a class="brand" href="/" aria-label="Evergreen home">
  <img src="/assets/logo.png" alt="" />
  <span class="brand-name"><b>Evergreen</b>@if($label)<span>{{ $label }}</span>@endif</span>
</a>
