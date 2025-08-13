<?php

use App\Http\Controllers\ProductsPageController;
use App\Http\Controllers\ProductFormPageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/page', function () {
//    return view('page');
//});

Route::get('/page', fn () => view('page'))->name('page');


// соответствует resources/views/products/index.blade.php
//Route::get('/products', function () {
//    return view('products.index');
//});

Route::get('/products', ProductsPageController::class)
    ->name('products.page');

Route::get('/products/create', [ProductFormPageController::class, 'create'])
    ->name('products.create.page');

Route::get('/products/{product}', [ProductFormPageController::class, 'show'])
    ->name('products.show.page');

Route::get('/products/{product}/edit', [ProductFormPageController::class, 'edit'])
    ->name('products.edit.page');



