@props(['active' => false, 'icon' => null, 'label'])

<button {{ $attributes->merge(['class' => 'flex flex-col items-center gap-1.5 shrink-0']) }} type="button">
    <span @class([
        'flex h-12 w-12 items-center justify-center rounded-2xl text-xl transition',
        'bg-brand-900 text-white shadow-card' => $active,
        'bg-white/80 text-brand-700 border border-brand-100' => ! $active,
    ])>
        {{ $icon }}
    </span>
    <span @class([
        'text-[11px] font-medium',
        'text-brand-900' => $active,
        'text-brand-500' => ! $active,
    ])>{{ $label }}</span>
</button>
