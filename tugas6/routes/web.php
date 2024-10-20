<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Route Utama
|--------------------------------------------------------------------------
*/
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

/*
|--------------------------------------------------------------------------
| Dashboard Route
|--------------------------------------------------------------------------
*/
Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile Routes (Protected by Authentication)
|--------------------------------------------------------------------------
*/
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Tutorial Routes
|--------------------------------------------------------------------------
*/
Route::prefix('/tutorial')->group(function () {
    Route::inertia('/directive', 'Tutorial/Directive', ['title' => 'Vue Directive'])
        ->name('vue.tutorial.directive');

    Route::inertia('/reactive', 'Tutorial/Reactive', ['title' => 'Vue Reactivity'])
        ->name('vue.tutorial.reactive');

    Route::inertia('/watch', 'Tutorial/Watch', ['title' => 'Vue Watcher'])
        ->name('vue.tutorial.watcher');

    Route::inertia('/component', 'Tutorial/Component', ['title' => 'Vue Component'])
        ->name('vue.tutorial.component');

    Route::inertia('/lifecycle', 'Tutorial/Lifecycle', ['title' => 'Component Lifecycle'])
        ->name('vue.tutorial.lifecycle');

    Route::inertia('/syntax', 'Tutorial/Syntax', ['title' => 'Vue Syntax Examples'])
        ->name('vue.tutorial.syntax');
    
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
