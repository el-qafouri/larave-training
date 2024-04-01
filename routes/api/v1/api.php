<?php

use App\Http\Controllers\API\V1;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => ''], function () {
    Route::group(['prefix' => 'orders'], function () {
        Route::get('', [V1\OrderController::class, 'index'])->name('orders.index');
    });
    Route::group(['prefix' => 'auth'], function () {
        Route::post('login', [V1\AuthController::class, 'login'])->name('login');
        Route::post('verify', [V1\AuthController::class, 'verify'])->name('verify');
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'users'], function () {
            Route::get('information', [V1\UserController::class, 'showInformation'])->name('users.information');

            Route::group(['prefix' => 'addresses'], function () {
                Route::get('', [V1\UserAddressController::class, 'index']);
                Route::post('', [V1\UserAddressController::class, 'store']);
                Route::get('/{address}', [V1\UserAddressController::class, 'show']);
                Route::put('/{address}', [V1\UserAddressController::class, 'update']);
            });
        });
        Route::group(['prefix' => 'addresses'], function () {
            Route::get('', [V1\AddressController::class, 'index']);
        });
    });

});
