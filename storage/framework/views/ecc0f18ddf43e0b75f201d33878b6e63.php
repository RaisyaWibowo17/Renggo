<?php
    $user = auth()->user();
    $isOwner = $user?->isOwner();
?>

<nav class="fixed bottom-0 left-1/2 z-40 w-full max-w-md -translate-x-1/2 px-4 pb-4">
    <div class="glass-strong flex items-center justify-between rounded-4xl px-3 py-2.5">
        <?php if($isOwner): ?>
            <a href="<?php echo e(route('owner.dashboard')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('owner.dashboard') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Dashboard
            </a>
            <a href="<?php echo e(route('owner.promo.index')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('owner.promo.*') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M7 7h.01M7 3h5.586a1 1 0 01.707.293l6.414 6.414a1 1 0 010 1.414l-8.586 8.586a1 1 0 01-1.414 0l-6.414-6.414A1 1 0 013 12.586V7a4 4 0 014-4z"/></svg>
                Promo
            </a>
            <a href="<?php echo e(route('owner.umkm.edit')); ?>" class="-mt-6 flex h-14 w-14 items-center justify-center rounded-full bg-brand-900 text-white shadow-glass-lg transition active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"/></svg>
            </a>
            <a href="<?php echo e(route('home')); ?>" class="bottom-nav-item w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 12a9 9 0 11-18 0 9 9 0 0118 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M9.75 9.75h4.5v4.5h-4.5z"/></svg>
                Katalog
            </a>
            <a href="<?php echo e(route('profile.edit')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil
            </a>
        <?php else: ?>
            <a href="<?php echo e(route('home')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('home') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M3 12l2-2m0 0l7-7 7 7M5 10v10a1 1 0 001 1h3m10-11l2 2m-2-2v10a1 1 0 01-1 1h-3m-6 0a1 1 0 001-1v-4a1 1 0 011-1h2a1 1 0 011 1v4a1 1 0 001 1m-6 0h6"/></svg>
                Home
            </a>
            <a href="<?php echo e(route('umkm.index')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('umkm.index') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M21 21l-4.35-4.35M18 11a7 7 0 11-14 0 7 7 0 0114 0z"/></svg>
                Explore
            </a>
            <a href="<?php echo e($user ? route('login.owner') : route('register.owner')); ?>" class="-mt-6 flex h-14 w-14 items-center justify-center rounded-full bg-brand-900 text-white shadow-glass-lg transition active:scale-95">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M12 4v16m8-8H4"/></svg>
            </a>
            <a href="<?php echo e($user ? route('favorite.index') : route('login.customer')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('favorite.*') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/></svg>
                Favorit
            </a>
            <a href="<?php echo e($user ? route('profile.edit') : route('login.customer')); ?>" class="bottom-nav-item <?php echo e(request()->routeIs('profile.*') ? 'active' : ''); ?> w-14">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/></svg>
                Profil
            </a>
        <?php endif; ?>
    </div>
</nav><?php /**PATH C:\xampp\htdocs\renggo\resources\views/components/bottom-nav.blade.php ENDPATH**/ ?>