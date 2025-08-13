<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UsersController extends Controller
{

    use AuthorizesRequests;
    //
    public function index()
    {
        $this->authorize('view-any', User::class);
        return User::all();
    }


    public function frontUsers() {
        $this->authorize('view-any', \App\Models\User::class);
        $users = \App\Models\User::all();
        return view('users.front', compact('users'));
    }

}



