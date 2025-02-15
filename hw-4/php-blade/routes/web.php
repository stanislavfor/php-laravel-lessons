<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmployeeController;

//Route::get('/', function () {
//    return view('welcome');
//});

Route::get('/', function () {
    return view('home', [
        'name' => 'John Doe',
        'age' => 35,
        'position' => 'Developer',
        'address' => 'Anytown, USA'
    ]);
});

Route::get('/contacts', function () {
    return view('contacts', [
        'address' => 'Anytown, USA',
        'post_code' => '1234567',
        'email' => 'example@example.com',
        'phone' => '555-1234-5678'
    ]);
});

Route::get('get-employee-data', [EmployeeController::class, 'index']);
Route::post('store-form', [EmployeeController::class, 'store']);
Route::get('store-form', [EmployeeController::class, 'showStoredData']);
Route::put('user/{id}', [EmployeeController::class, 'update']);
