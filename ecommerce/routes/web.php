<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('view.product');

Route::get('/carts', function () {
    return view('carts', ['title' => 'Carts']);
});

Route::prefix('dashboard')->middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('admin.dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');

    Route::resource('products', ProductController::class)->middleware(['auth', 'verified']);
    Route::resource('products-categories', ProductCategoryController::class)->middleware(['auth', 'verified']);
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
