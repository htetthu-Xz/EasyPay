<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;


Auth::routes();

Route::get('/', [\App\Http\Controllers\Frontend\PageController::class, 'home'])->name('home');

Route::get('admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.get.login');
Route::post('admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login');

Route::get('/admin', function () {
    return 'Admin Page';
});
