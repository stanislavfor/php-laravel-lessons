<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LogController;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('/logs', function() {
//    return view('logs');
//});

Route::get('/logs', [LogController::class, 'index']);
