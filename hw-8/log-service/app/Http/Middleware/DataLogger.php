<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Log;
//use Symfony\Component\HttpFoundation\Response;
//use Illuminate\Support\Facades\File;



//class DataLogger
//{
//    private $start_time;
//
////    public function handle(Request $request, Closure $next)
////    {
////        $startTime = microtime(true);
////
////        $response = $next($request);
////
////        $endTime = microtime(true);
////        $duration = ($endTime - $startTime) * 1000; // in milliseconds
////
////        // Log data
////        Log::create([
////            'time' => now(),
////            'duration' => $duration,
////            'ip' => $request->ip(),
////            'url' => $request->fullUrl(),
////            'method' => $request->method(),
////            'input' => json_encode($request->all()),
////        ]);
////
////        \Log::info('Log created successfully'); // Временное логирование
////
////        return $response;
////    }
//
//
//    /**
//     * Handle an incoming request.
//     *
//     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
//     */
//    public function handle(Request $request, Closure $next): Response
//    {
//        $this->start_time = microtime(true);
//        return $next($request);
//    }
//
//    public function terminate(Request $request, Response $response): void // Функция, которая вызывается после посылки ответа пользователю
//    {
//        if (env("API_DATALOGGER", true))  // Если в env файле прописана опция API_DATALOGGER = true используем логгирование
//        {
//            if (env("API_DATALOGGER_USE_DB", true)) // Если в env файле прописана опция API_DATALOGGER_USE_DB = true
//                // то для сохранения используем БД иначе пишем просто в файл
//            {
//                $endTime = microtime(true);
//                $log = new Log();
//                $log->time = gmdate('Y-m-d H:i:s');
//                $log->duration = number_format($endTime - $this->start_time, 3);
//                $log->ip = $request->ip();
//                $log->url = $request->fullUrl();
//                $log->method = $request->method();
//                $log->input = $request->getContent();
//                $log->save(); // Сохраняли в базу нашу запись
//            } else // На всякий случей, если спция звлиси в БД-недоступна, лезем в файл
//            {
//                $endTime = microtime(true);
//                $filename = 'api_datalogger_' . date('d-m-y') . '.log';
//                $dataToLog = 'Time: ' . gmdate('F j, Y, g:i a', $endTime) . "\n";
//                $dataToLog .= 'Duration: ' . number_format($endTime - LARAVEL_START, 3) . "\n";
//                $dataToLog .= 'IP Address: ' . $request->ip() . "\n";
//                $dataToLog .= 'URL: ' . $request->fullUrl() . "\n";
//                $dataToLog .= 'Method: ' . $request->method() . "\n";
//                $dataToLog .= 'Input: ' . $request->getContent() . "\n";
//                \File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . "vi", str_repeat('!', 20) . "vi\n");
//            }
//        }
//    }
//}



class DataLogger
{
    private $start_time;

    public function handle(Request $request, Closure $next): Response
    {
        $this->start_time = microtime(true);
        return $next($request);
    }

    public function terminate(Request $request, Response $response): void
    {
        if (env("API_DATALOGGER", true)) {
            if (env("API_DATALOGGER_USE_DB", true)) {
                $endTime = microtime(true);
                $log = new Log();
                $log->time = gmdate('Y-m-d H:i:s');
                $log->duration = number_format($endTime - $this->start_time, 3);
                $log->ip = $request->ip();
                $log->url = $request->fullUrl();
                $log->method = $request->method();
                $log->input = $request->getContent();
                $log->save();
            } else {
                $endTime = microtime(true);
                $filename = 'api_datalogger_' . date('d-m-y') . '.log';
                $dataToLog = 'Time: ' . gmdate('F j, Y, g:i a', $endTime) . "\n";
                $dataToLog .= 'Duration: ' . number_format($endTime - $this->start_time, 3) . "\n";
                $dataToLog .= 'IP Address: ' . $request->ip() . "\n";
                $dataToLog .= 'URL: ' . $request->fullUrl() . "\n";
                $dataToLog .= 'Method: ' . $request->method() . "\n";
                $dataToLog .= 'Input: ' . $request->getContent() . "\n";
                File::append(storage_path('logs' . DIRECTORY_SEPARATOR . $filename), $dataToLog . str_repeat('!', 20) . "\n");
            }
        }
    }
}



