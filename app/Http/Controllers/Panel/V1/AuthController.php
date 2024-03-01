<?php

namespace App\Http\Controllers\Panel\V1;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    public function showLoginPage()
    {
    return view('auth.login');
    }



}
