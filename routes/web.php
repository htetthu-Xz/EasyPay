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
    Route::get('/transfer/check-phone', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'checkPhone'])->name('transfer.check.phone');
    Route::post('/transfer/confirm', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'transferConfirm'])->name('transfer.confirm');
    Route::get('/transfer/confirm/check-password', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'checkPassword'])->name('transfer.check.password');
    Route::post('/transfer/complete', [\App\Http\Controllers\Frontend\MoneyTransferController::class, 'transferComplete'])->name('transfer.complete');

    #Wallet
    Route::get('/wallet', [\App\Http\Controllers\Frontend\PageController::class, 'wallet'])->name('wallet.page');

    #Profile
    Route::get('/profile', [\App\Http\Controllers\Frontend\PageController::class, 'profile'])->name('profile.page');

    #Password Update
    Route::get('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'getPasswordUpdateForm'])->name('profile.password.update.form');
    Route::post('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'updatePassword'])->name('profile.password.update');
});