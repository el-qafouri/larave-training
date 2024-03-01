<?php

namespace App\Http\Controllers;

use App\Http\Requests\LoginRequest;
use App\Http\Requests\RegisterRequest;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function showRegister()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.register');
    }

    //    public function register(Request $request)
    //    {
    //        $request->validate([
    //            'name' => 'required',
    //            'email' => 'required|email|unique:users',
    //            'password' => 'required|confirmed'
    //        ]);
    //        $data['name'] = $request->name;
    //        $data['email'] = $request->email;
    //        $data['password'] = Hash::make($request->password);
    //        $user = User::create([
    //            'name' => $request->name,
    //            'email' => $request->email,
    //            'password' => Hash::make($request->password),
    //        ]);
    //        if (!$user) {
    //            return redirect()->route('register.showRegister')->with("error", "register failed");
    //        }
    //        return redirect()->route('login')->with("success", "registration completed");
    //    }

    public function register(RegisterRequest $request)
    {
        $validated = $request->validated();
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
        ]);
        if ($user) {
            return redirect()->route('login')->with('success', 'Registration completed');
        } else {
            return redirect()->route('register.showRegister')->with('error', 'Registration failed');
        }

    }

    public function showLogin()
    {
        if (Auth::check()) {
            return redirect()->route('home');
        }

        return view('auth.login');
    }

    public function login(LoginRequest $request)
    {
        //        $create = $request->validate([
        //            'email' => 'required',
        //            'password' => 'required',
        //        ]);
        $create = $request->only('email', 'password');
        if (Auth::attempt($create)) {
            return redirect()->intended(route('home'));
        }

        //        return redirect()->route('login')->with("error", "login details are not valid");
        return redirect()->route('login');
    }

    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function index()
    {

        //        $breadcrumbs = [];
        $breadcrumbs = ['title' => 'home', 'url' => route('index.home')];

        return view('welcome', compact('breadcrumbs'));
    }
}
