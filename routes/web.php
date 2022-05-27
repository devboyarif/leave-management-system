<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\EmployeeController;


Route::get('/', function () {
    // return inertia('test/login');
    return redirect()->route('dashboard');
    return inertia('index');
});

Route::middleware('auth')->group(function () {
    Route::get('/about', function () {
        return inertia('about');
    })->name('about');

    Route::get('/contact', function () {
        return inertia('contact');
    })->name('contact');

    Route::get('/dashboard', function () {
        return inertia('dashboard');
    })->name('dashboard')->middleware('auth');

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});


include(base_path('routes/auth.php'));
