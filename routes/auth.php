<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Employee\EmployeeController;

// Authentication routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout']);
Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::get('/setup-profile', [EmployeeController::class, 'setupProfile'])->name('employee.setup-profile');



Route::controller(DashboardController::class)->middleware('auth')->group(function () {
    Route::get('/user/dashboard', 'dashboard')->name('dashboard');
    Route::get('/admin/dashboard', 'adminDashboard')->name('admin.dashboard');
    Route::get('/employee/dashboard', 'employeeDashboard')->name('employee.dashboard');
    Route::get('/company/dashboard', 'companyDashboard')->name('company.dashboard');
});
