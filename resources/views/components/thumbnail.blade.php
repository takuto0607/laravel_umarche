@php

if ($type === 'shops') {
  $path = 'storage/shops/';
}

if ($type === 'products') {
  $path = 'storage/products/';
}

@endphp

<div>
  @if (file_exists($path . $filename))
    <img src="{{ asset($path . $filename) }}">
  @else
    <img src="{{ asset('images/no_image.jpg') }}">
  @endif
</div>