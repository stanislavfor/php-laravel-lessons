<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index()
    {
        return view('get-employee-data');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'surname' => 'required|string|max:255',
            'position' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:20',
            'birthdate' => 'nullable|date',
            'address' => 'nullable|string',
            'workData' => 'required|string',
        ]);

        $employeeId = uniqid('', true);

        // Преобразуем данные в формат JSON
        $addressJson = [
            'fullAddress' => $validatedData['address']
        ];

        $employeeData = array_merge($validatedData, [
            'id' => $employeeId,
            'address' => $addressJson,
        ]);

        // Сохраняем данные в файл JSON
        $employees = $this->getEmployees();
        $employees[] = $employeeData;
        Storage::put('employees.json', json_encode($employees, JSON_PRETTY_PRINT));

        return redirect('store-form');
    }

    public function showStoredData()
    {
        $employees = $this->getEmployees();
        return view('store-form', ['employees' => $employees]);
    }

//    private function getEmployees()
//    {
//        if (!Storage::exists('employees.json')) {
//            return [];
//        }
//
//        $content = Storage::get('employees.json');
//        return json_decode($content, true) ?? [];
//    }

    private function getEmployees()
    {
        if (!Storage::exists('employees.json')) {
            Storage::put('employees.json', json_encode([]));
        }

        return json_decode(Storage::get('employees.json'), true) ?? [];
    }

}
