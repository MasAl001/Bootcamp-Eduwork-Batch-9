<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', function () {
    return view('home', ['title' => 'Home']);
});

Route::get('/products', function () {
    return view('products', ['title' => 'Products']);
});

Route::get('/cart', function () {
    return view('cart', ['title' => 'Cart']);
});
