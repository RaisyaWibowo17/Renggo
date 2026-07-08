<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Explore']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Explore']); ?>
    <div class="space-y-5">
        <div>
            <h1 class="text-lg font-bold text-brand-950">Explore UMKM</h1>
            <p class="text-xs text-brand-500">Temukan usaha lokal di desamu</p>
        </div>

        <form action="<?php echo e(route('umkm.index')); ?>" method="GET" class="flex items-center gap-2 rounded-2xl bg-white/85 px-4 py-3 shadow-card border border-white/70">
            <svg xmlns="http://www.w3.org/2000/svg" class="h-4.5 w-4.5 shrink-0 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 11a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
            <input type="text" name="q" value="<?php echo e($q); ?>" placeholder="Cari nama, kategori, alamat..." class="w-full bg-transparent text-sm outline-none placeholder:text-brand-400">
            <input type="hidden" name="kategori" value="<?php echo e($activeCategory); ?>">
        </form>

        <div class="no-scrollbar flex gap-2 overflow-x-auto pb-1">
            <a href="<?php echo e(route('umkm.index', array_filter(['q' => $q]))); ?>"
               class="shrink-0 rounded-full px-4 py-2 text-xs font-semibold <?php echo e($activeCategory === 'semua' ? 'bg-brand-900 text-white' : 'bg-white/80 text-brand-700 border border-brand-100'); ?>">
                Semua
            </a>
            <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e(route('umkm.index', array_filter(['q' => $q, 'kategori' => $category->slug]))); ?>"
                   class="shrink-0 rounded-full px-4 py-2 text-xs font-semibold <?php echo e($activeCategory === $category->slug ? 'bg-brand-900 text-white' : 'bg-white/80 text-brand-700 border border-brand-100'); ?>">
                    <?php echo e($category->name); ?>

                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        </div>

        <p class="text-xs text-brand-400"><?php echo e($umkms->total()); ?> UMKM ditemukan</p>

        <div class="grid grid-cols-2 gap-3">
            <?php $__empty_1 = true; $__currentLoopData = $umkms; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <?php if (isset($component)) { $__componentOriginalf7a10d7ace5d3fe28ae9c730ec874b8a = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalf7a10d7ace5d3fe28ae9c730ec874b8a = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.umkm-card','data' => ['umkm' => $umkm]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('umkm-card'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['umkm' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($umkm)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalf7a10d7ace5d3fe28ae9c730ec874b8a)): ?>
<?php $attributes = $__attributesOriginalf7a10d7ace5d3fe28ae9c730ec874b8a; ?>
<?php unset($__attributesOriginalf7a10d7ace5d3fe28ae9c730ec874b8a); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalf7a10d7ace5d3fe28ae9c730ec874b8a)): ?>
<?php $component = $__componentOriginalf7a10d7ace5d3fe28ae9c730ec874b8a; ?>
<?php unset($__componentOriginalf7a10d7ace5d3fe28ae9c730ec874b8a); ?>
<?php endif; ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <div class="glass col-span-2 rounded-3xl p-6 text-center">
                    <p class="text-sm font-semibold text-brand-900">Tidak ada UMKM ditemukan</p>
                    <p class="mt-1 text-xs text-brand-400">Coba kata kunci atau kategori lain.</p>
                </div>
            <?php endif; ?>
        </div>

        <div>
            <?php echo e($umkms->links()); ?>

        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $attributes = $__attributesOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__attributesOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal5863877a5171c196453bfa0bd807e410)): ?>
<?php $component = $__componentOriginal5863877a5171c196453bfa0bd807e410; ?>
<?php unset($__componentOriginal5863877a5171c196453bfa0bd807e410); ?>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/umkm/search.blade.php ENDPATH**/ ?>