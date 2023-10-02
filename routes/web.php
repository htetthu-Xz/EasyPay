<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

// Admin User Auth
Route::get('admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'showLoginForm'])->name('admin.get.login');
Route::post('admin/login', [\App\Http\Controllers\Auth\AdminLoginController::class, 'login'])->name('admin.login');
Route::post('admin/logout', [\App\Http\Controllers\Auth\AdminLoginController::class, 'logout'])->name('admin.logout');

// User Auth
Auth::routes();

Route::group([
    'middleware' => 'auth'
], function () {
    # Home
    Route::get('/', [\App\Http\Controllers\Frontend\PageController::class, 'home'])->name('home');

    #Money Transfer
    Route::get('/transfer', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'index'])->name('transfer.index');
    Route::post('/transfer/confirm', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'transferConfirm'])->name('transfer.confirm');

    #Wallet
    Route::get('/wallet', [\App\Http\Controllers\Frontend\PageController::class, 'wallet'])->name('wallet.page');

    #Profile
    Route::get('/profile', [\App\Http\Controllers\Frontend\PageController::class, 'profile'])->name('profile.page');

    #Password Update
    Route::get('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'getPasswordUpdateForm'])->name('profile.password.update.form');
    Route::post('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'updatePassword'])->name('profile.password.update');
});