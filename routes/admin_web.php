<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;

Route::group([
        'prefix' => 'admin',
        'middleware' => 'auth:admin_user'
    ], function () {
        Route::get('/', [PageController::class, 'home']);
    });