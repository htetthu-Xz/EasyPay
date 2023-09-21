<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\PageController;
use App\Http\Controllers\Backend\AdminUserController;

Route::group([
    'prefix' => 'admin',
    'middleware' => 'auth:admin_user'
], function () {
    Route::get('/', [PageController::class, 'home'])->name('admin.dashboard');

    Route::resource('admin-user', AdminUserController::class);
    Route::get('admin-user/datatable/server-side-data', [AdminUserController::class, 'serverSideData'])->name('admin.admin-user.data');
});