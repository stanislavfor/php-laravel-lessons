<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/index', [BookController::class, 'index'])->name('books.index');
Route::post('/store', [BookController::class, 'store'])->name('books.store');
Route::get('/books', [BookController::class, 'show'])->name('books.show');
Route::get('/info', [BookController::class, 'info'])->name('books.info');
