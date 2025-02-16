<?php

namespace App\Http\Controllers;

use App\Models\ProjectUser;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Response;


//class PdfGeneratorController extends Controller
//{
//    public function generatePdf($id)
//    {
//        try {
//            $pdf = Pdf::loadHTML('<h1>Тест PDF</h1>');
//            return $pdf->download("test.pdf");
//        } catch (\Exception $e) {
//            return response()->json([
//                'error' => 'Ошибка генерации PDF.',
//                'message' => $e->getMessage()
//            ], 500);
//        }
//    }
//}

//class PdfGeneratorController extends Controller
//{
//    public function generatePdf($id)
//    {
//        try {
//            $user = ProjectUser::findOrFail($id);
//
//            // Проверка работы шаблона
//            return view('user_pdf', compact('user'));
//
//            $pdf = Pdf::loadView('user_pdf', compact('user'));
//            return $pdf->download("user_{$id}.pdf");
//        } catch (\Exception $e) {
//            return response()->json([
//                'error' => 'Ошибка генерации PDF.',
//                'message' => $e->getMessage()
//            ], 500);
//        }
//    }
//}

//class PdfGeneratorController extends Controller
//{
//    public function generatePdf($id)
//    {
//        try {
//            $user = ProjectUser::findOrFail($id);
//            // Проверка, что загружаются данные пользователя
//            dd($user);
//            $pdf = dd(Pdf::class);Pdf::loadView('user_pdf', compact('user')); // Проверка импорта для Barryvdh\DomPDF\Facade\Pdf
//
//            $pdf = Pdf::loadView('user_pdf', compact('user'));
//            return $pdf->download("user_{$id}.pdf");
//        } catch (\Exception $e) {
//            return response()->json([
//                'error' => 'Пользователь не найден или не удалось сгенерировать PDF-файл.',
//                'message' => $e->getMessage() // Выводим сообщение ошибки
//            ], 500);
//        }
//    }
//}


//class PdfGeneratorController extends Controller
//{
//    public function generatePdf($id)
//    {
//        try {
//            $user = ProjectUser::findOrFail($id);
//            $pdf = Pdf::loadView('user_pdf', compact('user'));
//            return $pdf->stream('user{$id}.pdf');
//        } catch (\Exception $e) {
//            return response()->json(['error' => 'Пользователь не найден или не удалось сгенерировать PDF-файл.'], 404);
//        }
//    }
//}

//class PdfGeneratorController extends Controller
//{
//    public function generatePdf($id)
//    {
//        try {
//            $user = ProjectUser::findOrFail($id);
//            $pdf = PDF::loadView('user_pdf', compact('user'));
//            return $pdf->download("user_{$id}.pdf");
//        } catch (\Exception $e) {
//            return response()->json(['error' => 'Пользователь не найден или не удалось сгенерировать PDF-файл.'], 404);
//        }
//    }
//}

class PdfGeneratorController extends Controller
{
    public function generatePdf($id)
    {
        try {
            $user = ProjectUser::findOrFail($id);
            // Генерация PDF с использованием фасада Pdf
            $pdf = Pdf::loadView('user_pdf', compact('user'));
            return $pdf->download("user_{$id}.pdf");
        } catch (\Exception $e) {
            return response()->json(['error' => 'Пользователь не найден или не удалось сгенерировать PDF-файл.'], 404);
        }
    }
}
