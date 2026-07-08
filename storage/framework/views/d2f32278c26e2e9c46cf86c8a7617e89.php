<?php if(session('success') || session('error') || session('info') || $errors->any()): ?>
    <div
        x-data="{ show: true }"
        x-show="show"
        x-init="setTimeout(() => show = false, 4000)"
        x-transition
        class="fixed top-4 left-1/2 z-50 w-[calc(100%-2rem)] max-w-md -translate-x-1/2"
    >
        <?php if(session('success')): ?>
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-brand-900">
                <span class="text-accent-green">●</span> <?php echo e(session('success')); ?>

            </div>
        <?php elseif(session('error')): ?>
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-rose-700">
                <span class="text-rose-500">●</span> <?php echo e(session('error')); ?>

            </div>
        <?php elseif(session('info')): ?>
            <div class="glass-strong flex items-center gap-2 rounded-2xl px-4 py-3 text-sm font-medium text-brand-900">
                <span class="text-brand-500">●</span> <?php echo e(session('info')); ?>

            </div>
        <?php elseif($errors->any()): ?>
            <div class="glass-strong rounded-2xl px-4 py-3 text-sm font-medium text-rose-700">
                <p class="mb-1 flex items-center gap-2"><span class="text-rose-500">●</span> Periksa kembali data Anda:</p>
                <ul class="list-inside list-disc space-y-0.5 pl-1 text-xs">
                    <?php $__currentLoopData = $errors->all(); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $error): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <li><?php echo e($error); ?></li>
                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                </ul>
            </div>
        <?php endif; ?>
    </div>
<?php endif; ?>
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/components/toast.blade.php ENDPATH**/ ?>