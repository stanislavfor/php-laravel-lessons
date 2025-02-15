<?php

use Illuminate\Support\Facades\Route;
use App\Models\Employee;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test_database', function () {
    $employee = new Employee();
    $employee->name = 'John';
    $employee->lastname = 'Doe';
    $employee->position = 'Developer';
    $employee->salary = 50000;
    $employee->save();

    return 'new Employee создан успешно!';
});

