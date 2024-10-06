<?php

use App\Http\Controllers\api\auth\LoginController;
use App\Http\Controllers\api\auth\LogoutController;
use App\Http\Controllers\api\auth\RegisterController;
use App\Http\Controllers\api\ProductController;
use App\Http\Controllers\api\UserController;
use App\Http\Controllers\api\CartController;
use App\Http\Controllers\api\OrderController;
use Illuminate\Support\Facades\Route;

Route::prefix('/supermarket')->middleware('throttle:60,1')->group(function () {
    
    // Public routes for registration and login
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class);
    Route::post('/logout', LogoutController::class)->middleware('auth:sanctum');
    
    // Protected routes that require authentication
    Route::middleware(['auth:sanctum'])->group(function () {
        
        // Routes for managing products
        Route::prefix('/products')->group(function () {
            Route::get('/', [ProductController::class, 'index']);  // View all products
            Route::get('/{id}', [ProductController::class, 'show']); // View single product
            
            Route::middleware(['role:admin'])->group(function () {
                Route::post('/', [ProductController::class, 'store']);  // Add a product
                Route::put('/{id}', [ProductController::class, 'update']);  // Update product
                Route::delete('/{id}', [ProductController::class, 'destroy']);  // Delete product
            });
        });

        // Routes for managing categories
        Route::prefix('/users')->group(function () {
            Route::middleware(['role:admin'])->group(function () {
                Route::get('/', [UserController::class, 'index']);  // View all categories
                Route::get('/{id}', [UserController::class, 'show']);  // View single category
                Route::post('/', [UserController::class, 'store']);  // Add a category
                Route::put('/{id}', [UserController::class, 'update']);  // Update category
                Route::delete('/{id}', [UserController::class, 'destroy']);  // Delete category
            });
        });

        // Routes for managing the cart
        Route::prefix('/cart')->group(function () {
            Route::get('/', [CartController::class, 'index']);  // View current cart
            Route::post('/cart', [CartController::class, 'add']);  // Add product to cart
            Route::delete('/remove/{id}', [CartController::class, 'remove']);  // Remove product from cart
            Route::post('/checkout', [CartController::class, 'checkout']);  // Checkout
        });

        // Routes for managing orders
        Route::prefix('/orders')->group(function () {
            Route::get('/me', [OrderController::class, 'myOrders']);  // View user’s orders
            Route::middleware(['role:admin|staff'])->group(function () {
                Route::get('/', [OrderController::class, 'index']);  // View all orders (admin/staff only)
                Route::get('/{id}', [OrderController::class, 'show']);  // View a single order
                Route::post('/{id}/process', [OrderController::class, 'processOrder']);  // Process an order
                Route::post('/{id}/cancel', [OrderController::class, 'cancelOrder']);  // Cancel an order
            });
        });
    });
});

// Fallback for undefined routes
Route::fallback(function () {
    return response()->json(['message' => 'Not Found'], 404);
});
