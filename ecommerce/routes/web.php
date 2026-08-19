<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [HomeController::class, 'index']);

Route::get('/products/{slug}', [ProductController::class, 'show'])->name('view.product');

Route::get('/carts', function () {
    return view('carts', ['title' => 'Carts']);
});
