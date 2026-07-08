<?php $attributes ??= new \Illuminate\View\ComponentAttributeBag;

$__newAttributes = [];
$__propNames = \Illuminate\View\ComponentAttributeBag::extractPropNames((['active' => false, 'icon' => null, 'label']));

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

foreach (array_filter((['active' => false, 'icon' => null, 'label']), 'is_string', ARRAY_FILTER_USE_KEY) as $__key => $__value) {
    $$__key = $$__key ?? $__value;
}

$__defined_vars = get_defined_vars();

foreach ($attributes->all() as $__key => $__value) {
    if (array_key_exists($__key, $__defined_vars)) unset($$__key);
}

unset($__defined_vars, $__key, $__value); ?>

<button <?php echo e($attributes->merge(['class' => 'flex flex-col items-center gap-1.5 shrink-0'])); ?> type="button">
    <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'flex h-12 w-12 items-center justify-center rounded-2xl text-xl transition',
        'bg-brand-900 text-white shadow-card' => $active,
        'bg-white/80 text-brand-700 border border-brand-100' => ! $active,
    ]); ?>">
        <?php echo e($icon); ?>

    </span>
    <span class="<?php echo \Illuminate\Support\Arr::toCssClasses([
        'text-[11px] font-medium',
        'text-brand-900' => $active,
        'text-brand-500' => ! $active,
    ]); ?>"><?php echo e($label); ?></span>
</button>
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/components/category-pill.blade.php ENDPATH**/ ?>