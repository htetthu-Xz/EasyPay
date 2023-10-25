<?php

use Illuminate\Support\Facades\Route;

#auth
Route::post('register', [\App\Http\Controllers\Api\Auth\AuthController::class, 'register']);
Route::post('login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);


Route::group([
    'middleware' => 'auth:api'
], function() {
    #logout
    Route::post('logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);

    #user data
    Route::get('profile', [\App\Http\Controllers\Api\PageController::class, 'profile']);

    #transaction
    Route::get('transactions', [\App\Http\Controllers\Api\PageController::class, 'transaction']);
    Route::get('transactions/{trx_id}', [\App\Http\Controllers\Api\PageController::class, 'transactionDetail']);

    #Notification
    Route::get('notifications', [\App\Http\Controllers\Api\PageController::class, 'notification']);
    Route::get('notifications/{id}', [\App\Http\Controllers\Api\PageController::class, 'notificationDetail']);
});