<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;


Route::get('/', function () {
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

    // Users
    Route::resource('/users', UserController::class)->middleware('auth');

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});


include(base_path('routes/auth.php'));
