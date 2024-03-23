<?php

use App\Http\Controllers\API\V1\AuthController;
use App\Http\Controllers\API\V1\OrderController;
use App\Http\Controllers\API\V1\UserController;
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
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [OrderController::class, 'index'])->name('orders.index');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [AuthController::class, 'login'])->name('login');
        Route::post('verify', [AuthController::class, 'verify'])->name('verify');
    });

    Route::group(['prefix' => 'users', 'middleware' => 'auth:sanctum'], function () {
        Route::get('information', [UserController::class, 'showInformation'])->name('users.information');
    });
});
