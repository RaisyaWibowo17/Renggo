@props(['label' => 'Daftarkan'])

<div x-data="{ open: false }" @keydown.escape.window="open = false" class="contents">
    <button type="button" @click="open = true" {{ $attributes }}>
        {{ $slot->isEmpty() ? $label : $slot }}
    </button>

    <template x-teleport="body">
        <div
            x-show="open"
            x-cloak
            x-transition.opacity
            class="fixed inset-0 z-[70] flex items-end justify-center bg-brand-950/50 backdrop-blur-sm px-4 pb-4 sm:items-center sm:pb-0"
        >
            <div
                x-show="open"
                @click.outside="open = false"
                x-transition:enter="transition ease-out duration-200"
                x-transition:enter-start="opacity-0 translate-y-6 scale-95"
                x-transition:enter-end="opacity-100 translate-y-0 scale-100"
                class="glass-strong w-full max-w-sm rounded-4xl p-6 text-center"
            >
                <div class="mx-auto mb-4 flex h-14 w-14 items-center justify-center rounded-3xl bg-brand-900 text-white shadow-glass-lg">
                    <i data-lucide="store" class="h-7 w-7"></i>
                </div>
                <h3 class="text-lg font-bold text-brand-950">Ingin mendaftarkan UMKM?</h3>
                <p class="mt-2 text-sm leading-relaxed text-brand-500">
                    Untuk mendaftarkan UMKM, Anda harus memiliki akun <span class="font-semibold text-brand-700">Pemilik UMKM</span> — akun ini terpisah dari akun Pelanggan yang sedang Anda gunakan.
                </p>
                <div class="mt-5 flex flex-col gap-2">
                    <a href="{{ route('register.owner') }}" class="btn-primary w-full">
                        <i data-lucide="store" class="h-4 w-4"></i>
                        Daftar sebagai Pemilik
                    </a>
                    <button type="button" @click="open = false" class="btn-ghost w-full justify-center">Batal</button>
                </div>
            </div>
        </div>
    </template>
</div>