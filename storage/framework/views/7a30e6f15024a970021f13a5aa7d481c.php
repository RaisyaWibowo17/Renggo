<?php if (isset($component)) { $__componentOriginal5863877a5171c196453bfa0bd807e410 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal5863877a5171c196453bfa0bd807e410 = $attributes; } ?>
<?php $component = Illuminate\View\AnonymousComponent::resolve(['view' => 'components.layouts.app','data' => ['title' => 'Profil Saya']] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('layouts.app'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\Illuminate\View\AnonymousComponent::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes(['title' => 'Profil Saya']); ?>
    <div class="space-y-5">
        <div class="flex items-center gap-3">
            <div class="flex h-16 w-16 items-center justify-center overflow-hidden rounded-3xl bg-brand-100 shadow-card">
                <?php if($user->profile_photo_url): ?>
                    <img src="<?php echo e($user->profile_photo_url); ?>" class="h-full w-full object-cover" alt="<?php echo e($user->name); ?>">
                <?php else: ?>
                    <span class="text-xl font-bold text-brand-700"><?php echo e(mb_substr($user->name, 0, 1)); ?></span>
                <?php endif; ?>
            </div>
            <div>
                <h1 class="text-lg font-bold text-brand-950"><?php echo e($user->name); ?></h1>
                <p class="pill mt-1 bg-brand-50 text-brand-700"><?php echo e($user->isOwner() ? 'Pemilik UMKM' : 'Pelanggan'); ?></p>
            </div>
        </div>

        <form action="<?php echo e(route('profile.update')); ?>" method="POST" enctype="multipart/form-data" class="card space-y-4 p-4">
            <?php echo csrf_field(); ?>
            <?php echo method_field('PATCH'); ?>

            <div>
                <label class="field-label">Nama</label>
                <input type="text" name="name" value="<?php echo e(old('name', $user->name)); ?>" class="input-field" required>
            </div>
            <div>
                <label class="field-label">Username</label>
                <input type="text" name="username" value="<?php echo e(old('username', $user->username)); ?>" class="input-field" required>
            </div>
            <?php if($user->isCustomer()): ?>
                <div>
                    <label class="field-label">Email</label>
                    <input type="email" name="email" value="<?php echo e(old('email', $user->email)); ?>" class="input-field">
                </div>
            <?php endif; ?>
            <div>
                <label class="field-label">Nomor HP</label>
                <input type="text" name="phone" value="<?php echo e(old('phone', $user->phone)); ?>" class="input-field" required>
            </div>
            <?php if($user->isOwner()): ?>
                <div>
                    <label class="field-label">RW</label>
                    <select name="rw" class="input-field">
                        <?php for($i = 1; $i <= 15; $i++): ?>
                            <option value="<?php echo e($i); ?>" <?php if(old('rw', $user->rw) == $i): echo 'selected'; endif; ?>>RW <?php echo e($i); ?></option>
                        <?php endfor; ?>
                    </select>
                </div>
            <?php endif; ?>
            <div>
                <label class="field-label">Ganti Foto Profil</label>
                <input type="file" name="profile_photo" accept="image/*" class="w-full text-xs text-brand-500 file:mr-3 file:rounded-xl file:border-0 file:bg-brand-50 file:px-3 file:py-2 file:text-xs file:font-semibold file:text-brand-700">
            </div>

            <button type="submit" class="btn-primary w-full">Simpan Perubahan</button>
        </form>

        <a href="<?php echo e(route('profile.password')); ?>" class="btn-secondary w-full">Ganti Password</a>

        <form action="<?php echo e(route('logout')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <button type="submit" class="btn-ghost w-full justify-center text-rose-600">Keluar</button>
        </form>
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
<?php /**PATH C:\xampp\htdocs\renggo\resources\views/profile/edit.blade.php ENDPATH**/ ?>