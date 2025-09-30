<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


// Route Home dan Dashboard
Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard', function () {
    return view('dashboard');
});

// Route Product Management
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::post('/products', [ProductController::class, 'store'])->name('products.store');

// DataTables source
Route::get('/products/datatable', [ProductController::class, 'show'])->name('show.product');

// API ringan untuk ambil satu product (edit)
Route::get('/products/{product}', [ProductController::class, 'get'])->name('products.get');

// Update & Delete (Menggunakan PUT dan DELETE sesuai best practice)
Route::put('/products/{product}', [ProductController::class, 'update'])->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

// Route Cart (dibiarkan sesuai aslinya)
Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update', [CartController::class, 'update'])->name('cart.update');
Route::post('/cart/remove', [CartController::class, 'remove'])->name('cart.remove');
Route::get('/cart/fragment', [CartController::class, 'fragment'])->name('cart.fragment');

Auth::routes();
