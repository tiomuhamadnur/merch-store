<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class UsersControllers extends Controller
{
    public function index()
    {
        $users = User::get();

        return view('settings.user.index', compact('users'));
    }

    public function edit()
    {
        return view('settings.user.edit');
    }
}
