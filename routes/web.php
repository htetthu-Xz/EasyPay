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
    
    #Transaction
    Route::get('/transaction', [\App\Http\Controllers\Frontend\PageController::class, 'transaction'])->name('transaction.page');
    Route::get('/transaction/{transaction:trx_id}', [\App\Http\Controllers\Frontend\PageController::class, 'transactionDetail'])->name('transaction.detail');

    #Profile
    Route::get('/profile', [\App\Http\Controllers\Frontend\PageController::class, 'profile'])->name('profile.page');

    #Password Update
    Route::get('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'getPasswordUpdateForm'])->name('profile.password.update.form');
    Route::post('/update-password', [\App\Http\Controllers\Frontend\PageController::class, 'updatePassword'])->name('profile.password.update');

    #QR
    Route::get('/receive-qr', [\App\Http\Controllers\Frontend\PageController::class, 'receiveQR'])->name('receive.qr');
    Route::get('/scan-and-pay', [\App\Http\Controllers\Frontend\PageController::class, 'scanAndPay'])->name('scan.qr');
    Route::get('/scan-and-pay-form', [\App\Http\Controllers\Frontend\PageController::class, 'scanAndPayForm'])->name('scan.pay.form');

    #notification
    Route::get('/notification', [\App\Http\Controllers\Frontend\NotificationController::class, 'index'])->name('notification.page');
    Route::get('/notification/{id}', [\App\Http\Controllers\Frontend\NotificationController::class, 'detail'])->name('notification.detail');
});