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
use App\Http\Controllers\Frontend\AuthController as FrontendAuthController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\SendRequestController;
use Illuminate\Support\Facades\Route;

#Admin
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
    Route::post('/mark-requests-read', [SupportRequestController::class, 'markRequestsRead'])->name('admin.mark-requests-read');
    Route::resource('/user', UserController::class);
    Route::resource('/customer', CustomerController::class);
    Route::resource('/role', RoleController::class);
    Route::resource('/permission', PermissionController::class);
    Route::resource('/department', DepartmentController::class);
    Route::resource('/support-request', SupportRequestController::class);
    Route::post('/support-request/{id}/confirm', [SupportRequestController::class, 'confirm'])->name('sr.confirm');
    Route::post('/support-request/{id}/cancle', [SupportRequestController::class, 'cancle'])->name('sr.cancle');
    Route::get('/support-request/{id}/reply', [SupportRequestController::class, 'reply'])->name('sr.reply');
    Route::post('/support-request/reply', [SupportRequestController::class, 'handle_reply'])->name('sr.handle_reply');
});

#Customer
Route::get('/', [HomeController::class, 'home'])->name('customer.dashboard');
Route::get('/customer/register', [FrontendAuthController::class, 'form_register'])->name('customer.register_page');
Route::get('/customer/login', [FrontendAuthController::class, 'form_login'])->name('customer.login_page');
Route::post('/customer/register', [FrontendAuthController::class, 'register'])->name('customer.register');
Route::post('/customer/login', [FrontendAuthController::class, 'login'])->name('customer.login');
Route::get('/customer/logout', [FrontendAuthController::class, 'logout'])->name('customer.logout');
Route::get('/customer/profile', [FrontendAuthController::class, 'profile'])->name('customer.profile');
Route::get('/customer/overview', [FrontendAuthController::class, 'overview'])->name('customer.overview');
Route::get('/customer/change-password', [FrontendAuthController::class, 'page_change_password'])->name('customer.page_change-password');
Route::post('/customer/change-password', [FrontendAuthController::class, 'change_password'])->name('customer.change-password');
Route::get('/customer/edit-account', [FrontendAuthController::class, 'page_edit_account'])->name('customer.page_edit-account');
Route::post('/customer/edit-account', [FrontendAuthController::class, 'edit_account'])->name('customer.edit-account');
Route::post('/customer/change-avatar', [FrontendAuthController::class, 'change_avatar'])->name('customer.change-avatar');

Route::post('/send-request', [SendRequestController::class, 'send_request'])->name('customer.send-request');
