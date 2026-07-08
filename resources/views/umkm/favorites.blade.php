<x-layouts.app title="Favorit">
    <div class="space-y-5">
        <h1 class="text-lg font-bold text-brand-950">UMKM Favorit</h1>

        <div class="grid grid-cols-2 gap-3">
            @forelse ($umkms as $umkm)
                <x-umkm-card :umkm="$umkm" />
            @empty
                <div class="glass col-span-2 rounded-3xl p-6 text-center">
                    <p class="text-sm font-semibold text-brand-900">Belum ada favorit</p>
                    <p class="mt-1 text-xs text-brand-400">Simpan UMKM yang Anda suka di sini.</p>
                    <a href="{{ route('umkm.index') }}" class="btn-primary mt-4 inline-flex">Jelajahi UMKM</a>
                </div>
            @endforelse
        </div>

        <div>{{ $umkms->links() }}</div>
    </div>
</x-layouts.app>
