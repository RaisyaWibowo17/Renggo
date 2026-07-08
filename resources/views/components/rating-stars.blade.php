@props(['rating' => 0, 'size' => 'sm'])

@php
    $sizeClass = $size === 'lg' ? 'h-5 w-5' : ($size === 'md' ? 'h-4 w-4' : 'h-3.5 w-3.5');
@endphp

<span {{ $attributes->merge(['class' => 'inline-flex items-center gap-1']) }}>
    <svg xmlns="http://www.w3.org/2000/svg" class="{{ $sizeClass }} fill-accent-amber text-accent-amber" viewBox="0 0 20 20">
        <path d="M10 1.5l2.6 5.27 5.82.85-4.21 4.1 1 5.8L10 14.9l-5.21 2.74 1-5.8-4.21-4.1 5.82-.85L10 1.5z"/>
    </svg>
    <span class="text-xs font-semibold text-brand-900">{{ number_format((float) $rating, 1) }}</span>
</span>
