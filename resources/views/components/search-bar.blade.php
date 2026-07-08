@props(['action', 'value' => null, 'placeholder' => 'Cari UMKM, produk, kategori...'])

<form action="{{ $action }}" method="GET" class="flex items-center gap-2 rounded-2xl bg-white/85 px-4 py-3 shadow-card border border-white/70">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 11a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    <input
        type="text"
        name="q"
        value="{{ $value }}"
        placeholder="{{ $placeholder }}"
        class="w-full bg-transparent text-sm text-brand-950 placeholder:text-brand-400 outline-none"
    >
</form>
