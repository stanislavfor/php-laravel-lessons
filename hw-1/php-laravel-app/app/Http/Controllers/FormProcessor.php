<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormProcessor extends Controller
{
    // public function store(Request $request)
    // {

    //     $firstName = $request->input('first_name');
    //     $lastName = $request->input('last_name');
    //     $email = $request->input('email');

    //     // Данные в виде JSON-объекта
    //     return response()->json([
    //         'first_name' => $firstName,
    //         'last_name' => $lastName,
    //         'email' => $email
    //     ]);
    // }

    public function store(Request $request)
    {
        // Получаем данные из запроса
        $firstName = $request->input('first_name');
        $lastName = $request->input('last_name');
        $email = $request->input('email');

        // Представление с данными пользователя
        return view('user.greeting', [
            'firstName' => $firstName,
            'lastName' => $lastName,
            'email' => $email
        ]);
    }
}
