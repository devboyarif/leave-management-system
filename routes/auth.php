<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Auth\ForgetPasswordController;

// Authentication routes
Route::controller(LoginController::class)->group(function () {
    Route::get('/login', 'showLoginForm')->name('login');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

Route::controller(RegisterController::class)->group(function () {
    Route::get('/register', 'showRegisterForm')->name('register.form');
    Route::post('/register', 'register')->name('register');
});

Route::controller(ForgetPasswordController::class)->group(function () {
    Route::get('/request/email', 'passwordEmail')->name('password.email');
    Route::post('/email/send/code', 'sendCode')->name('password.email.send.code');
    Route::get('/password/reset/{email}', 'passwordResetForm')->name('password.reset.form');
    Route::post('/password/reset', 'passwordReset')->name('password.reset');
});


// Roles dashboard routes
Route::controller(DashboardController::class)->middleware(['auth','check.company.setup'])->group(function () {
    Route::get('/user/dashboard', 'dashboard')->name('dashboard');
    // Route::get('/user/dashboard', 'dashboard')->name('dashboard')->middleware('check.company.setup');
    Route::get('/employee/dashboard', 'employeeDashboard')->name('employee.dashboard');
    Route::get('/company/dashboard', 'companyDashboard')->name('company.dashboard');

    // Admin routes
    Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
    // Route::get('/admin/dashboard/', 'adminDashboard')->name('admin.dashboard');
});
