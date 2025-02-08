<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FormProcessor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userform', [UserController::class, 'index']);
Route::post('/store_form', [FormProcessor::class, 'store']);
