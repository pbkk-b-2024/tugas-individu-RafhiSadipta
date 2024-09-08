<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OpController;
use App\Http\Controllers\RouteController;

Route::get('/', function(){
    return view('layout.app');
});

Route::prefix('/Operation')->group(function(){
    Route::get('/genapGanjil',[OpController::class,'genapGanjil'])->name('genapganjil');
    Route::get('/fibonacci',[OpController::class,'fibonacci'])->name('fibonacci');
    Route::get('/prima', [OpController::class, 'bilanganPrima'])->name('prima');
});

Route::prefix('/Rute')->group(function(){
    Route::get('/param', fn() => view('Rute.param'))->name('param');
    Route::get('/param/{param1}', [RouteController::class, 'param1'])->name('param1');
    Route::get('/param/{param1}/{param2}', [RouteController::class, 'param2'])->name('param2');
});

Route::fallback(function () {
    return redirect('/');
});