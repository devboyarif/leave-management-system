<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LeaveRequestController;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/about', function () {
        return inertia('about');
    })->name('about');

    Route::get('/contact', function () {
        return inertia('contact');
    })->name('contact');

    Route::get('/dashboard', function () {
        return inertia('dashboard');
    })->name('dashboard');

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::get('/companies/teams/{user}', [CompanyController::class, 'companiesTeams'])->name('companies.teams');

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Teams
    Route::resource('/teams', TeamController::class);

    // Leave Types & Request
    Route::resource('/leaveTypes', LeaveTypeController::class);
    Route::resource('/leaveRequests', LeaveRequestController::class);

    // Holidays
    Route::resource('/holidays', HolidayController::class);

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});
