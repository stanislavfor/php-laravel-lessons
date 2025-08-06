<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{

    use AuthorizesRequests;
    //
    public function index()
    {
        $this->authorize('view-any', User::class);
        return User::all();
    }

}



