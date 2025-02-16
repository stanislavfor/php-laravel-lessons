<?php

use App\Http\Controllers\PdfGeneratorController;
use App\Http\Controllers\ProjectUserController;
use app\Models\ProjectUser;
use Illuminate\Support\Facades\Route;
use Barryvdh\DomPDF\Facade\Pdf;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/user_form', [ProjectUserController::class, 'create']);
Route::post('/store-user', [ProjectUserController::class, 'store']); // Сохранение пользователя
Route::get('/users', [ProjectUserController::class, 'index']); // Вывод всех пользователей
Route::get('/user/{id}', [ProjectUserController::class, 'show']);
// Генерация PDF
Route::get('/user/{id}/pdf', [PdfGeneratorController::class, 'generatePdf']);

//Route::get('/file_show', function (){return response()->file(base_path().'/test.txt');});
//Route::get('/file_stream', function () {
//    return response()->streamDownload(function (){
//        echo file_get_contents('https://google.com');}, 'google.html');});
//Route::get('/user/{id}/pdf', function ($id) {
//    $user = ProjectUser::findOrFail($id);
//    $pdf = Pdf::loadView('user_pdf', compact('user'));
//    return $pdf->stream('user.pdf');
//});
