<?php

use App\Http\Controllers\Panel\V1\AuthController;
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

Route::group(['prefix' => ''], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('login', [AuthController::class, 'showLoginPage'])->name('show.login');
        Route::post('login', [AuthController::class, 'showLoginPage'])->name('login');
    });
});

//Route::get('/', function () {
//    return view('welcome');
//})->name('home');

Route::get('home', [UserController::class, 'index'])->name('index.home');
