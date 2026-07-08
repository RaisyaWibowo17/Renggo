<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Favorit']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Favorit']); ?>
    <div class="space-y-5">
        <h1 class="text-lg font-bold text-brand-950">UMKM Favorit</h1>

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
                    <p class="text-sm font-semibold text-brand-900">Belum ada favorit</p>
                    <p class="mt-1 text-xs text-brand-400">Simpan UMKM yang Anda suka di sini.</p>
                    <a href="<?php echo e(route('umkm.index')); ?>" class="btn-primary mt-4 inline-flex">Jelajahi UMKM</a>
                </div>
            <?php endif; ?>
        </div>

        <div><?php echo e($umkms->links()); ?></div>
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
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/umkm/favorites.blade.php ENDPATH**/ ?>