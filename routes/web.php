<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');

//Route::get('/login', [UserController::class, 'showLogin'])->name('login');
//Route::post('/login', [UserController::class, 'login'])->name('login.login');
//Route::get('/register', [UserController::class, 'showRegister'])->name('register.showRegister');
//Route::post('/register', [UserController::class, 'register'])->name('register.register');
//Route::get('/logout', [UserController::class, 'logout'])->name('logout');


Route::get('/dashboard', [DashboardController::class, 'index']);

require __DIR__."/panel/v1/web.php";
