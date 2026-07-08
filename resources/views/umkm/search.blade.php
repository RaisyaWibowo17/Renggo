<x-layouts.app title="Explore">
    <div class="space-y-5">
        <div>
            <h1 class="text-lg font-bold text-brand-950">Explore UMKM</h1>
            <p class="text-xs text-brand-500">Temukan usaha lokal di desamu</p>
        </div>

        <form action="{{ route('umkm.index') }}" method="GET" class="flex items-center gap-2 rounded-2xl bg-white/85 px-4 py-3 shadow-card border border-white/70">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 11a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="q" value="{{ $q }}" placeholder="Cari nama, kategori, alamat..." class="w-full bg-transparent text-sm outline-none placeholder:text-brand-400">
            <input type="hidden" name="kategori" value="{{ $activeCategory }}">
        </form>

        <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
            <a href="{{ route('umkm.index', array_filter(['q' => $q])) }}"
               class="shrink-0 rounded-full px-4 py-2 text-xs font-semibold {{ $activeCategory === 'semua' ? 'bg-brand-900 text-white' : 'bg-white/80 text-brand-700 border border-brand-100' }}">
                Semua
            </a>
            @foreach ($categories as $category)
                <a href="{{ route('umkm.index', array_filter(['q' => $q, 'kategori' => $category->slug])) }}"
                   class="shrink-0 rounded-full px-4 py-2 text-xs font-semibold {{ $activeCategory === $category->slug ? 'bg-brand-900 text-white' : 'bg-white/80 text-brand-700 border border-brand-100' }}">
                    {{ $category->name }}
                </a>
            @endforeach
        </div>

        <p class="text-xs text-brand-400">{{ $umkms->total() }} UMKM ditemukan</p>

        <div class="grid grid-cols-2 gap-3">
            @forelse ($umkms as $umkm)
                <x-umkm-card :umkm="$umkm" />
            @empty
                <div class="glass col-span-2 rounded-3xl p-6 text-center">
                    <p class="text-sm font-semibold text-brand-900">Tidak ada UMKM ditemukan</p>
                    <p class="mt-1 text-xs text-brand-400">Coba kata kunci atau kategori lain.</p>
                </div>
            @endforelse
        </div>

        <div>
            {{ $umkms->links() }}
        </div>
    </div>
</x-layouts.app>
