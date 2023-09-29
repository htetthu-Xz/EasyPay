<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\WalletController;
use App\Http\Controllers\Backend\AdminUserController;

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:admin_user'
], function () {
    Route::get('/', [PageController::class, 'home'])->name('admin.dashboard');

    Route::resource('admin-user', AdminUserController::class);
    Route::get('admin-user/datatable/server-side-data', [AdminUserController::class, 'serverSideData'])->name('admin.admin-user.data');

    Route::resource('users', UserController::class);
    Route::get('user/datatable/server-side-data', [UserController::class, 'serverSideData'])->name('user.data');

    Route::get('wallet', [WalletController::class, 'index'])->name('wallets.index');
    Route::get('wallet/datatable/server-side-data', [WalletController::class, 'serverSideData'])->name('wallets.serve-side.data');
});