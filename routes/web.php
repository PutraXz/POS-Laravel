<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});
Route::get('/product', [ProductController::class, 'index']);
Route::post('/product', [ProductController::class, 'store'])->name('upload.product');
Route::get('/product-show', [ProductController::class, 'show'])->name('show.product');
Auth::routes();
