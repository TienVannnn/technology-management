<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin/login', [AuthController::class, 'login_form'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('handleLoginAdmin');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('admin.profile');
    Route::post('/change-info', [AuthController::class, 'changeInfo'])->name('admin.changeInfo');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::resource('/user', UserController::class);
});
