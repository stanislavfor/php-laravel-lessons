<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProjectUser;

class ProjectUserController extends Controller
{
    // Форма добавления пользователя
    public function create()
    {
        return view('user_form');
    }

    // Сохранение пользователя в БД
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:50',
            'surname' => 'required|string|max:50',
            'email' => 'required|email|unique:project_users,email|max:100',
        ]);

        ProjectUser::create($request->all());

        return redirect('/users')->with('success', 'Пользователь добавлен!');
    }

    // Вывод всех пользователей
    public function index()
    {
        $users = ProjectUser::all();
        return view('users', compact('users'));
    }

    // Вывод конкретного пользователя по ID
    public function show($id)
    {
        $user = ProjectUser::findOrFail($id);
        return view('user', compact('user'));
    }
}
