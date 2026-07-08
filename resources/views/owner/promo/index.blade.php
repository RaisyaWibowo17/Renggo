<x-layouts.app title="Kelola Promo">
    <div class="space-y-5">
        <div class="flex items-center justify-between">
            <h1 class="text-lg font-bold text-brand-950">Promo Saya</h1>
            <a href="{{ route('owner.promo.create') }}" class="btn-primary text-xs">+ Promo Baru</a>
        </div>

        <div class="space-y-3">
            @forelse ($promos as $promo)
                <div class="card flex gap-3 p-3">
                    @if ($promo->banner_path)
                        <img src="{{ $promo->banner_path }}" class="h-16 w-16 shrink-0 rounded-xl object-cover" alt="{{ $promo->title }}">
                    @else
                        <div class="flex h-16 w-16 shrink-0 items-center justify-center rounded-xl bg-brand-50 text-xl">🎉</div>
                    @endif
                    <div class="min-w-0 flex-1">
                        <div class="flex items-start justify-between gap-2">
                            <p class="truncate text-sm font-semibold text-brand-950">{{ $promo->title }}</p>
                            <span class="pill shrink-0 {{ $promo->is_active ? 'bg-emerald-50 text-emerald-700' : 'bg-brand-50 text-brand-400' }}">
                                {{ $promo->is_active ? 'Aktif' : 'Nonaktif' }}
                            </span>
                        </div>
                        <p class="mt-0.5 line-clamp-2 text-xs text-brand-500">{{ $promo->description }}</p>
                        <div class="mt-2 flex gap-3 text-xs font-semibold">
                            <a href="{{ route('owner.promo.edit', $promo) }}" class="text-brand-600">Edit</a>
                            <form action="{{ route('owner.promo.destroy', $promo) }}" method="POST" onsubmit="return confirm('Hapus promo ini?')">
                                @csrf @method('DELETE')
                                <button type="submit" class="text-rose-500">Hapus</button>
                            </form>
                        </div>
                    </div>
                </div>
            @empty
                <div class="glass rounded-3xl p-6 text-center">
                    <p class="text-sm font-semibold text-brand-900">Belum ada promo</p>
                    <p class="mt-1 text-xs text-brand-400">Buat promo untuk menarik lebih banyak pelanggan.</p>
                    <a href="{{ route('owner.promo.create') }}" class="btn-primary mt-4 inline-flex">Buat Promo</a>
                </div>
            @endforelse
        </div>
    </div>
</x-layouts.app>
