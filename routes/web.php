<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
    // return view('app', ['title' => 'product', 'products' => Product::all() ]); // Mengembalikan view app.blade.php
});

Route::resource('/products', ProductController::class, ['index' => 'products.index']);
Route::resource('/categories', CategoryController::class, ['index' => 'categories.index']);


