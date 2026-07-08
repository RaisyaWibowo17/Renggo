<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['action', 'value' => null, 'placeholder' => 'Cari UMKM, produk, kategori...']));

foreach ($attributes->all() as $__key => $__value) {
    if (in_array($__key, $__propNames)) {
        $$__key = $$__key ?? $__value;
    } else {
        $__newAttributes[$__key] = $__value;
    }
}

$attributes = new \Illuminate\View\ComponentAttributeBag($__newAttributes);

unset($__propNames);
unset($__newAttributes);

foreach (array_filter((['action', 'value' => null, 'placeholder' => 'Cari UMKM, produk, kategori...']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<form action="<?php echo e($action); ?>" method="GET" class="flex items-center gap-2 rounded-2xl bg-white/85 px-4 py-3 shadow-card border border-white/70">
    <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 11a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
    <input
        type="text"
        name="q"
        value="<?php echo e($value); ?>"
        placeholder="<?php echo e($placeholder); ?>"
        class="w-full bg-transparent text-sm text-brand-950 placeholder:text-brand-400 outline-none"
    >
</form>
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/components/search-bar.blade.php ENDPATH**/ ?>