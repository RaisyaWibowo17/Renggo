@props(['umkm'])

@php
    $cover = $umkm->photos->first()?->path ?? $umkm->cover_path;
@endphp

<a href="{{ route('umkm.show', $umkm->slug) }}" class="card block overflow-hidden">
    <div class="relative h-32 w-full bg-gradient-to-br from-brand-100 to-brand-200">
        @if ($cover)
            <img src="{{ $cover }}" alt="{{ $umkm->name }}" class="h-full w-full object-cover" loading="lazy">
        @else
            <div class="flex h-full w-full items-center justify-center text-brand-400">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M3 9.5L12 3l9 6.5V20a1 1 0 01-1 1h-4.5v-6h-7v6H4a1 1 0 01-1-1V9.5z"/></svg>
            </div>
        @endif

        @if ($umkm->category)
            <span class="pill absolute left-2.5 top-2.5 bg-white/85 text-brand-800">{{ $umkm->category->name }}</span>
        @endif
    </div>

    <div class="space-y-1 p-3">
        <div class="flex items-start justify-between gap-2">
            <h3 class="line-clamp-1 text-sm font-semibold text-brand-950">{{ $umkm->name }}</h3>
            <x-rating-stars :rating="$umkm->rating_average ?? 0" />
        </div>
        <p class="line-clamp-1 text-xs text-brand-500">{{ $umkm->business_field }}</p>
        <p class="flex items-center gap-1 text-xs text-brand-400">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
            {{ $umkm->address }}
        </p>
    </div>
</a>
