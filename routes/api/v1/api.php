<?php

use App\Http\Controllers\Panel\V1\AuthController;
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
        Route::get('', [\App\Http\Controllers\API\V1\OrderController::class, 'index'])->name('orders.index');
    });
    //    Route::group(['prefix' => 'auth'], function () {
    //        Route::get('login' , [AuthController::class , 'showLoginPage'])->name('show.login');
    //        Route::post('login' , [AuthController::class , 'showLoginPage'])->name('login');
    //    });
});
