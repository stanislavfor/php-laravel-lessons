<?php

use Illuminate\Support\Facades\Route;
use app\Http\Controllers\UserController;
use app\Http\Controllers\FormProcessor;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/userform', [UserController::class, 'index']);
Route::post('/store_form', [FormProcessor::class, 'store']);
