<?php

use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterCustomerController;
use App\Http\Controllers\Auth\RegisterOwnerController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\Owner\DashboardController;
use App\Http\Controllers\Owner\PromoController;
use App\Http\Controllers\Owner\UmkmController as OwnerUmkmController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\UmkmController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Public routes
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/explore', [UmkmController::class, 'index'])->name('umkm.index');
Route::get('/umkm/{umkm:slug}', [UmkmController::class, 'show'])->name('umkm.show');

/*
|--------------------------------------------------------------------------
| Guest-only auth routes
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {
    Route::get('/daftar/pelanggan', [RegisterCustomerController::class, 'create'])->name('register.customer');
    Route::post('/daftar/pelanggan', [RegisterCustomerController::class, 'store']);

    Route::get('/daftar/pemilik-umkm', [RegisterOwnerController::class, 'create'])->name('register.owner');
    Route::post('/daftar/pemilik-umkm', [RegisterOwnerController::class, 'store']);

    Route::get('/masuk/pelanggan', [LoginController::class, 'createCustomer'])->name('login.customer');
    Route::post('/masuk/pelanggan', [LoginController::class, 'storeCustomer']);

    Route::get('/masuk/pemilik-umkm', [LoginController::class, 'createOwner'])->name('login.owner');
    Route::post('/masuk/pemilik-umkm', [LoginController::class, 'storeOwner']);
});

Route::post('/keluar', [LoginController::class, 'destroy'])->middleware('auth')->name('logout');

/*
|--------------------------------------------------------------------------
| Authenticated routes (shared)
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profil', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profil', [ProfileController::class, 'update'])->name('profile.update');
    Route::get('/profil/password', [ProfileController::class, 'editPassword'])->name('profile.password');
    Route::put('/profil/password', [ProfileController::class, 'updatePassword'])->name('profile.password.update');
});

/*
|--------------------------------------------------------------------------
| Customer-only routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'customer'])->group(function () {
    Route::post('/umkm/{umkm}/favorit', [FavoriteController::class, 'toggle'])->name('favorite.toggle');
    Route::get('/favorit', [FavoriteController::class, 'index'])->name('favorite.index');

    Route::post('/umkm/{umkm}/review', [ReviewController::class, 'store'])->name('review.store');
    Route::put('/review/{review}', [ReviewController::class, 'update'])->name('review.update');
    Route::delete('/review/{review}', [ReviewController::class, 'destroy'])->name('review.destroy');
});

/*
|--------------------------------------------------------------------------
| Owner-only routes
|--------------------------------------------------------------------------
*/

Route::middleware(['auth', 'owner'])->prefix('owner')->name('owner.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    Route::get('/umkm/daftar', [OwnerUmkmController::class, 'create'])->name('umkm.create');
    Route::post('/umkm/daftar', [OwnerUmkmController::class, 'store'])->name('umkm.store');
    Route::get('/umkm/edit', [OwnerUmkmController::class, 'edit'])->name('umkm.edit');
    Route::put('/umkm/edit', [OwnerUmkmController::class, 'update'])->name('umkm.update');

    Route::get('/promo', [PromoController::class, 'index'])->name('promo.index');
    Route::get('/promo/baru', [PromoController::class, 'create'])->name('promo.create');
    Route::post('/promo/baru', [PromoController::class, 'store'])->name('promo.store');
    Route::get('/promo/{promo}/edit', [PromoController::class, 'edit'])->name('promo.edit');
    Route::put('/promo/{promo}', [PromoController::class, 'update'])->name('promo.update');
    Route::delete('/promo/{promo}', [PromoController::class, 'destroy'])->name('promo.destroy');
});
