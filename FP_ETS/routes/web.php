<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\DiscountController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Auth;

// Redirect ke halaman welcome sebagai default
Route::get('/', function () {
    return view('welcome'); // Change this to your welcome view
});

// Autentikasi bawaan Laravel (Login, Register, dll)
Auth::routes([
    'register' => true, // Ensure registration is enabled
    'login' => true, // Ensure login is enabled
]);

Route::get('/login', function() {
    return view('auth.login');
})->name('login');

Route::get('/register', function() {
    return view('auth.register');
})->name('register');

// Grup rute yang mengharuskan autentikasi dan pencatatan last login
Route::middleware(['auth', 'loglastlogin'])->group(function () {
    
    // Home setelah login
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // API Schema route (authenticated users only)
    Route::get('/api/schema', function () {
        return view('api.schema');
    });

    Route::get('reviews/{order_id}', [ReviewController::class, 'index'])->name('reviews.index');

    // Rute khusus admin
    Route::middleware(['role:admin'])->group(function () {
        // Rute CRUD untuk produk
        Route::resource('products', ProductController::class);

        // Rute CRUD untuk user (admin/user management)
        Route::resource('admin', UserController::class);

        Route::resource('categories', CategoryController::class);
        Route::resource('orders', OrderController::class);
        Route::get('/orders', [OrderController::class, 'index'])->name('orders.admin');
        Route::put('/orders/{order}/update-status', [OrderController::class, 'updateStatus'])->name('orders.updateStatus');
        Route::get('/orders/{order}', [OrderController::class, 'adminshow'])->name('orders.adminshow');
        Route::resource('discounts', DiscountController::class);
    });

    Route::middleware(['auth', 'role:pelanggan'])->group(function () {
        Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
        Route::post('/profile', [ProfileController::class, 'update'])->name('profile.update');
        Route::get('/katalog', [ProductController::class, 'katalog'])->name('products.katalog');
        Route::post('/cart/{product}', [CartController::class, 'addToCart'])->name('cart.add');
        Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
        Route::delete('/cart/{cart}', [CartController::class, 'removeFromCart'])->name('cart.remove');
        Route::post('/checkout', [CartController::class, 'checkout'])->name('checkout');
        Route::get('/my-orders', [OrderController::class, 'myOrders'])->name('orders.myOrders');
        Route::get('/my-orders/{order}', [OrderController::class, 'show'])->name('orders.show');
        Route::post('/my-orders/{order}/complete', [OrderController::class, 'completeOrder'])->name('orders.complete');
        Route::post('/cart', [CartController::class, 'applyDiscount'])->name('cart.applyDiscount');
        Route::get('/reviews/create/{order_id}', [ReviewController::class, 'create'])->name('reviews.create');
        Route::post('/reviews/store', [ReviewController::class, 'store'])->name('reviews.store');
    });
});
