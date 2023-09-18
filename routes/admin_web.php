<?php

use Illuminate\Support\Facades\Route;

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:admin_user'
], function () {
    Route::get('/', function () {
        return 'Admin Page';
    });
});