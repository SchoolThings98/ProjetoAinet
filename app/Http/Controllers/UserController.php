<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;


class UserController extends Controller
{
     public function index(Request $request)
    {
        $listaUser = User::all();
        return view(
            'users.index');
    }
}
