<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Auth;

// Redirect ke halaman login sebagai default
Route::get('/', function () {
    return view('auth.login');
});

// Autentikasi bawaan Laravel (Login, Register, dll)
Auth::routes();

// Grup rute yang mengharuskan autentikasi dan pencatatan last login
Route::middleware(['auth', 'loglastlogin'])->group(function () {
    
    // Home setelah login
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    // Rute khusus admin
    Route::middleware(['role:admin'])->group(function () {
        // Rute CRUD untuk produk
        Route::resource('products', ProductController::class);

        // Rute CRUD untuk user (admin/user management)
        Route::resource('admin', UserController::class);
    });

    Route::middleware(['auth', 'role:pelanggan'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/katalog', [ProductController::class, 'katalog'])->name('products.katalog');
        Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::delete('/cart/{cart}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    });
});
