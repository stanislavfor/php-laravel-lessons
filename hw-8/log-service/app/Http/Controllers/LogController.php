<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Log;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class LogController extends Controller
{
    public function index(Request $request)
    {
        try {
            $query = Log::latest();

            if ($request->has('ip')) {
                $query->where('ip', $request->input('ip'));
            }

            if ($request->has('method')) {
                $query->where('method', $request->input('method'));
            }

            $logs = $query->paginate(15);
            return view('logs', compact('logs'));
        } catch (ModelNotFoundException $e) {
            return response()->json(['error' => 'Logs не найден'], 404);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Произошла ошибка'], 500);
        }
    }
}

//class LogController extends Controller
//{
////    public function index()
////    {
////        $logs = Log::latest()->get(); // Получаем все логи и сортируем по времени
////        return view('logs', compact('logs')); // Передаем данные в представление
////    }
//
//    public function index()
//    {
//        $logs = Log::orderBy('time', 'desc')->get();
//        return view('logs', compact('logs'));
//    }
//}
