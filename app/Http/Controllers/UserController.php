<?php

namespace Ehtiket\Http\Controllers;

use Illuminate\Http\Request;
use app\User;

class UserController extends Controller
{
    public function register(Request $request)
    {
        return view('app.register');
    }
}