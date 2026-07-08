<x-layouts.app title="Dashboard">
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <div>
                <p class="text-xs text-brand-400">Dashboard Owner</p>
                <h1 class="text-lg font-bold text-brand-950">{{ $umkm->name }}</h1>
            </div>
            <a href="{{ route('umkm.show', $umkm->slug) }}" class="btn-ghost text-xs">Lihat Halaman</a>
        </div>

        {{-- Stat cards --}}
        <div class="grid grid-cols-2 gap-3">
            <div class="card p-4">
                <p class="text-xs text-brand-400">Total View</p>
                <p class="mt-1 text-2xl font-bold text-brand-950">{{ $stats['total_view'] }}</p>
            </div>
            <div class="card p-4">
                <p class="text-xs text-brand-400">Total Favorit</p>
                <p class="mt-1 text-2xl font-bold text-brand-950">{{ $stats['total_favorit'] }}</p>
            </div>
            <div class="card p-4">
                <p class="text-xs text-brand-400">Total Review</p>
                <p class="mt-1 text-2xl font-bold text-brand-950">{{ $stats['total_review'] }}</p>
            </div>
            <div class="card p-4">
                <p class="text-xs text-brand-400">Rating Rata-rata</p>
                <p class="mt-1 text-2xl font-bold text-brand-950">{{ $stats['rating_rata_rata'] ?: '-' }}</p>
            </div>
        </div>

        {{-- Daftar Promo --}}
        <div>
            <div class="mb-2 flex items-center justify-between">
                <h2 class="text-sm font-bold text-brand-950">Daftar Promo</h2>
                <a href="{{ route('owner.promo.index') }}" class="text-xs font-semibold text-brand-500">Kelola</a>
            </div>
            <div class="no-scrollbar flex gap-3 overflow-x-auto pb-1">
                @forelse ($umkm->promos as $promo)
                    <div class="w-56 shrink-0 card p-3">
                        <p class="text-sm font-semibold text-brand-950">{{ $promo->title }}</p>
                        <p class="mt-1 line-clamp-2 text-xs text-brand-500">{{ $promo->description }}</p>
                        <span class="pill mt-2 {{ $promo->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-brand-50 text-brand-400' }}">
                            {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                        </span>
                    </div>
                @empty
                    <a href="{{ route('owner.promo.create') }}" class="card flex w-56 shrink-0 flex-col items-center justify-center gap-1 p-4 text-center">
                        <span class="text-2xl">🎉</span>
                        <span class="text-xs font-semibold text-brand-700">Buat Promo Pertama</span>
                    </a>
                @endforelse
            </div>
        </div>

        {{-- Daftar Foto --}}
        <div>
            <h2 class="mb-2 text-sm font-bold text-brand-950">Daftar Foto</h2>
            <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
                @forelse ($umkm->gallery as $photo)
                    <img src="{{ $photo->path }}" class="h-24 w-24 shrink-0 rounded-2xl object-cover shadow-card" alt="Galeri">
                @empty
                    <p class="text-sm text-brand-400">Belum ada foto galeri.</p>
                @endforelse
            </div>
        </div>

        {{-- Aktivitas --}}
        <div>
            <h2 class="mb-2 text-sm font-bold text-brand-950">Daftar Aktivitas</h2>
            <div class="card divide-y divide-brand-50">
                @forelse ($activities as $activity)
                    <div class="flex items-center justify-between px-4 py-3 text-sm">
                        <span class="text-brand-700">
                            @switch($activity->type)
                                @case('view') Halaman UMKM dilihat @break
                                @case('favorite') Ditambahkan ke favorit @break
                                @case('review') Review baru diterima @break
                                @default {{ $activity->description ?? 'Aktivitas' }}
                            @endswitch
                        </span>
                        <span class="text-xs text-brand-400">{{ $activity->created_at->diffForHumans() }}</span>
                    </div>
                @empty
                    <p class="px-4 py-4 text-sm text-brand-400">Belum ada aktivitas.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-layouts.app>
