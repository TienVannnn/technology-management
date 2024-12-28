<?php

use App\Http\Controllers\Backend\AuthController;
use App\Http\Controllers\Backend\CustomerController;
use App\Http\Controllers\Backend\DashboardController;
use App\Http\Controllers\Backend\DepartmentController;
use App\Http\Controllers\Backend\PermissionController;
use App\Http\Controllers\Backend\ReusableController;
use App\Http\Controllers\Backend\RoleController;
use App\Http\Controllers\Backend\UserController;
use App\Http\Controllers\Backend\SupportRequestController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});
Route::post('/change-status/{id}/{slug}', [ReusableController::class, 'changeStatus'])->name('reusable.changeStatus');
Route::get('/admin/login', [AuthController::class, 'login_form'])->name('login');
Route::post('/admin/login', [AuthController::class, 'login'])->name('handleLoginAdmin');
Route::get('/admin/forgot-password', [AuthController::class, 'forgot_password'])->name('admin.forgotpassword');
Route::post('/admin/forgot-password', [AuthController::class, 'handle_forgot_password'])->name('admin.handle_forgot_password');
Route::get('/admin/recovery-password', [AuthController::class, 'recovery_password'])->name('admin.form_recovery');
Route::post('/admin/recovery-password', [AuthController::class, 'hanle_recovery_password'])->name('admin.handle_recovery');
Route::get('admin/support-request/history/search', [SupportRequestController::class, 'search_history'])->middleware('auth')->name('sr.search_history');
Route::prefix('admin')->middleware('auth')->group(function () {
    Route::get('/logout', [AuthController::class, 'logout'])->name('admin.logout');
    Route::get('/profile', [AuthController::class, 'profile'])->name('admin.profile');
    Route::post('/change-info', [AuthController::class, 'changeInfo'])->name('admin.changeInfo');
    Route::get('/', [DashboardController::class, 'index'])->name('admin.dashboard');
    Route::get('/support-request/history', [SupportRequestController::class, 'history'])->name('sr.history');
    Route::get('/support-request/history/{id}', [SupportRequestController::class, 'history_detail'])->name('sr.history_detail');
    Route::delete('/support-request/history/{id}/delete', [SupportRequestController::class, 'history_delete'])->name('sr.history_delete');

    Route::get('/support-request/search', [SupportRequestController::class, 'search'])->name('sr.search');
    Route::resource('/user', UserController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/support-request', SupportRequestController::class);
});
