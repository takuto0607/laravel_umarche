@props(['status' => 'info'])

@php
    if ($status === 'info') { $bgColor = 'bg-blue-300'; }
    if ($status === 'error') { $bgColor = 'bg-red-500'; }
@endphp

@if (session('message'))
    <div class="{{ $bgColor }} w-1/2 mx-auto text-white">
      {{ session('message') }}
    </div>
@endif