<x-layouts.app title="Beranda">
    <div class="space-y-6">
        {{-- Lokasi --}}
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] font-medium text-brand-400">Lokasi Anda</p>
                <p class="flex items-center gap-1 text-sm font-semibold text-brand-950">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Desa Candirenggo, Malang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </p>
            </div>
            <a href="{{ auth()->check() ? route('profile.edit') : route('login.customer') }}" class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/80 border border-white shadow-card">
                @if (auth()->user()?->profile_photo_url)
                    <img src="{{ auth()->user()->profile_photo_url }}" class="h-full w-full rounded-2xl object-cover" alt="Profil">
                @else
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                @endif
            </a>
        </div>

        <x-search-bar :action="route('umkm.index')" />

        {{-- Hero --}}
        <div class="relative overflow-hidden rounded-4xl bg-gradient-to-br from-brand-800 via-brand-700 to-brand-500 p-6 text-white shadow-glass-lg">
            <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-10 -left-6 h-28 w-28 rounded-full bg-white/10"></div>
            <span class="pill relative bg-white/15 text-white">#BanggaBuatanDesa</span>
            <h1 class="relative mt-3 text-2xl font-bold leading-tight">Temukan UMKM Desa</h1>
            <p class="relative mt-1.5 max-w-[85%] text-sm text-white/85">Jelajahi produk lokal, dukung usaha tetangga, dan temukan potensi tersembunyi di sekitarmu.</p>
            <div class="relative mt-4 flex gap-2">
                <a href="{{ route('umkm.index') }}" class="rounded-2xl bg-white px-4 py-2.5 text-sm font-semibold text-brand-900 shadow-card">Jelajahi UMKM</a>
                <a href="{{ auth()->user()?->isOwner() ? route('owner.dashboard') : route('register.owner') }}" class="rounded-2xl border border-white/40 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white">Daftarkan</a>
            </div>
        </div>

        {{-- Kategori --}}
        <div>
            <h2 class="mb-3 text-base font-bold text-brand-950">Kategori Pilihan</h2>
            <div class="no-scrollbar flex gap-3 overflow-x-auto pb-1">
                <a href="{{ route('umkm.index') }}"><x-category-pill icon="🔲" label="Semua" :active="true" /></a>
                @foreach ($categories as $category)
                    <a href="{{ route('umkm.index', ['kategori' => $category->slug]) }}">
                        <x-category-pill :icon="$category->icon ?? '🏷️'" :label="$category->name" />
                    </a>
                @endforeach
            </div>
        </div>

        {{-- Unggulan --}}
        <div>
            <div class="mb-3 flex items-center justify-between">
                <h2 class="text-base font-bold text-brand-950">UMKM Unggulan</h2>
                <a href="{{ route('umkm.index') }}" class="text-xs font-semibold text-brand-500">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 gap-3">
                @forelse ($featured as $umkm)
                    <x-umkm-card :umkm="$umkm" />
                @empty
                    <p class="col-span-2 text-sm text-brand-400">Belum ada UMKM unggulan.</p>
                @endforelse
            </div>
        </div>

        {{-- Terbaru --}}
        <div>
            <h2 class="mb-3 text-base font-bold text-brand-950">UMKM Terbaru</h2>
            <div class="grid grid-cols-2 gap-3">
                @forelse ($latest as $umkm)
                    <x-umkm-card :umkm="$umkm" />
                @empty
                    <p class="col-span-2 text-sm text-brand-400">Belum ada UMKM terbaru.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
