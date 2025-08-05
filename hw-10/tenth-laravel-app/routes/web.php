<?php

use Illuminate\Support\Facades\Route;

use Illuminate\Support\Facades\Log;

Route::get('/', function () {
    return view('welcome');
});


Route::get('/logs', function () {
    Log::info('Laravel log test');
    return 'Check logs';
});

