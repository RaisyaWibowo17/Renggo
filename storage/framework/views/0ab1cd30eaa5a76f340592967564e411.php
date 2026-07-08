<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Beranda']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Beranda']); ?>
    <div class="space-y-6">
        
        <div class="flex items-center justify-between">
            <div>
                <p class="text-[11px] font-medium text-brand-400">Lokasi Anda</p>
                <p class="flex items-center gap-1 text-sm font-semibold text-brand-950">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M17.657 16.657L13.414 20.9a2 2 0 01-2.828 0l-4.243-4.243a8 8 0 1111.314 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"/></svg>
                    Desa Candirenggo, Malang
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3.5 w-3.5 text-brand-400" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M19 9l-7 7-7-7"/></svg>
                </p>
            </div>
            <a href="<?php echo e(auth()->check() ? route('profile.edit') : route('login.customer')); ?>" class="flex h-10 w-10 items-center justify-center rounded-2xl bg-white/80 border border-white shadow-card">
                <?php if(auth()->user()?->profile_photo_url): ?>
                    <img src="<?php echo e(auth()->user()->profile_photo_url); ?>" class="h-full w-full rounded-2xl object-cover" alt="Profil">
                <?php else: ?>
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-brand-500" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                <?php endif; ?>
            </a>
        </div>

        <?php if (isset($component)) { $__componentOriginal61542037d001e2034791c9aff5866543 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal61542037d001e2034791c9aff5866543 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.search-bar','data' => ['action' => route('umkm.index')]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('search-bar'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['action' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute(route('umkm.index'))]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal61542037d001e2034791c9aff5866543)): ?>
<?php $attributes = $__attributesOriginal61542037d001e2034791c9aff5866543; ?>
<?php unset($__attributesOriginal61542037d001e2034791c9aff5866543); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal61542037d001e2034791c9aff5866543)): ?>
<?php $component = $__componentOriginal61542037d001e2034791c9aff5866543; ?>
<?php unset($__componentOriginal61542037d001e2034791c9aff5866543); ?>
<?php endif; ?>

        
        <div class="relative overflow-hidden rounded-4xl bg-gradient-to-br from-brand-800 via-brand-700 to-brand-500 p-6 text-white shadow-glass-lg">
            <div class="absolute -right-8 -top-8 h-32 w-32 rounded-full bg-white/10"></div>
            <div class="absolute -bottom-10 -left-6 h-28 w-28 rounded-full bg-white/10"></div>
            <span class="pill relative bg-white/15 text-white">#BanggaBuatanDesa</span>
            <h1 class="relative mt-3 text-2xl font-bold leading-tight">Temukan UMKM Desa</h1>
            <p class="relative mt-1.5 max-w-[85%] text-sm text-white/85">Jelajahi produk lokal, dukung usaha tetangga, dan temukan potensi tersembunyi di sekitarmu.</p>
            <div class="relative mt-4 flex gap-2">
                <a href="<?php echo e(route('umkm.index')); ?>" class="rounded-2xl bg-white px-4 py-2.5 text-sm font-semibold text-brand-900 shadow-card">Jelajahi UMKM</a>
                <a href="<?php echo e(auth()->user()?->isOwner() ? route('owner.dashboard') : route('register.owner')); ?>" class="rounded-2xl border border-white/40 bg-white/10 px-4 py-2.5 text-sm font-semibold text-white">Daftarkan</a>
            </div>
        </div>

        
        <div>
            <h2 class="mb-3 text-base font-bold text-brand-950">Kategori Pilihan</h2>
            <div class="no-scrollbar flex gap-3 overflow-x-auto pb-1">
                <a href="<?php echo e(route('umkm.index')); ?>"><?php if (isset($component)) { $__componentOriginalddd86c1b4d266cd65324ef62736414aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddd86c1b4d266cd65324ef62736414aa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-pill','data' => ['icon' => '🔲','label' => 'Semua','active' => true]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('category-pill'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => '🔲','label' => 'Semua','active' => true]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddd86c1b4d266cd65324ef62736414aa)): ?>
<?php $attributes = $__attributesOriginalddd86c1b4d266cd65324ef62736414aa; ?>
<?php unset($__attributesOriginalddd86c1b4d266cd65324ef62736414aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddd86c1b4d266cd65324ef62736414aa)): ?>
<?php $component = $__componentOriginalddd86c1b4d266cd65324ef62736414aa; ?>
<?php unset($__componentOriginalddd86c1b4d266cd65324ef62736414aa); ?>
<?php endif; ?></a>
                <?php $__currentLoopData = $categories; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $category): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e(route('umkm.index', ['kategori' => $category->slug])); ?>">
                        <?php if (isset($component)) { $__componentOriginalddd86c1b4d266cd65324ef62736414aa = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginalddd86c1b4d266cd65324ef62736414aa = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.category-pill','data' => ['icon' => $category->icon ?? '🏷️','label' => $category->name]] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('category-pill'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['icon' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->icon ?? '🏷️'),'label' => \Illuminate\View\Compilers\BladeCompiler::sanitizeComponentAttribute($category->name)]); ?>
<?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginalddd86c1b4d266cd65324ef62736414aa)): ?>
<?php $attributes = $__attributesOriginalddd86c1b4d266cd65324ef62736414aa; ?>
<?php unset($__attributesOriginalddd86c1b4d266cd65324ef62736414aa); ?>
<?php endif; ?>
<?php if (isset($__componentOriginalddd86c1b4d266cd65324ef62736414aa)): ?>
<?php $component = $__componentOriginalddd86c1b4d266cd65324ef62736414aa; ?>
<?php unset($__componentOriginalddd86c1b4d266cd65324ef62736414aa); ?>
<?php endif; ?>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </div>
        </div>

        
        <div>
            <div class="mb-3 flex items-center justify-between">
                <h2 class="text-base font-bold text-brand-950">UMKM Unggulan</h2>
                <a href="<?php echo e(route('umkm.index')); ?>" class="text-xs font-semibold text-brand-500">Lihat Semua</a>
            </div>
            <div class="grid grid-cols-2 gap-3">
                <?php $__empty_1 = true; $__currentLoopData = $featured; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                    <p class="col-span-2 text-sm text-brand-400">Belum ada UMKM unggulan.</p>
                <?php endif; ?>
            </div>
        </div>

        
        <div>
            <h2 class="mb-3 text-base font-bold text-brand-950">UMKM Terbaru</h2>
            <div class="grid grid-cols-2 gap-3">
                <?php $__empty_1 = true; $__currentLoopData = $latest; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $umkm): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
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
                    <p class="col-span-2 text-sm text-brand-400">Belum ada UMKM terbaru.</p>
                <?php endif; ?>
            </div>
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
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/home.blade.php ENDPATH**/ ?>