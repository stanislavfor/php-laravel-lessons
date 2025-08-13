<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UsersController;
use Telegram\Bot\Laravel\Facades\Telegram;
use Illuminate\Support\Facades\Log;
use Telegram\Bot\Exceptions\TelegramSDKException;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//Route::get('/dashboardii', function () {
//    return view('dashboardii');
//})->middleware(['auth', 'verified'])->name('dashboardii');

Route::get('/dashboardii', function () {
    return view('dashboardii', ['user' => auth()->user()]);
})->middleware(['auth', 'verified'])->name('dashboardii');

Route::get('/gallery', function () {
    return view('gallery');
})->middleware(['auth', 'verified'])->name('gallery');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/front/users', [UsersController::class, 'frontUsers']) ->name('front.users') ->middleware(['auth']);

Route::get('test-telegram', function () {
    try {
        Telegram::sendMessage([
            'chat_id'    => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'HTML',
            'text'       => "http://localhost:8000/test-telegram\nсообщение через web.php:\n\nпроизошло тестовое событие",
        ]);
        return response()->json(['status' => 'success']);

    } catch (\Throwable $e) {
        \Log::warning('Telegram error: ' . $e->getMessage());

        // Не роняем запрос, возвращаем фолбек
        return response()->json([
            'status'  => 'fail',
            'message' => 'Telegram temporarily unavailable',
        ], 202);
    }
});

Route::get('/test-telegram', function () {
    try {
        $res = Telegram::sendMessage([
            // важно: тут должен быть ЦИФРОВОЙ id канала вида -100xxxxxxxxxx
            'chat_id'    => env('TELEGRAM_CHANNEL_ID', ''),
            'parse_mode' => 'html',
            'text'       => 'Проверка связи: /test-telegram',
        ]);

        return response()->json(['status' => 'ok', 'result' => $res->toArray()]);
    } catch (TelegramSDKException $e) {
        Log::error('Telegram SDK error', ['error' => $e->getMessage()]);
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 503);
    } catch (\Throwable $e) {
        Log::error('Telegram generic error', ['error' => $e->getMessage()]);
        return response()->json(['status' => 'fail', 'message' => $e->getMessage()], 503);
    }
});



require __DIR__.'/auth.php';
Route::get('/users', [UsersController::class, 'index']);
