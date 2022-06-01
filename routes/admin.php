<?php

use Carbon\Carbon;
use App\Models\Calendar;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveTypeController;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/test', function () {

        // $calendar = Calendar::first();
        // return addDays($calendar->end_date, 1);

        // $date = Carbon::createFromFormat('Y-m-d', $calendar->end_date);
        // $daysToAdd = 1;
        // $date = $date->addDays($daysToAdd);

        // return [
        //     'calendar' => $calendar,
        //     'date' => $date->format('Y-m-d'),
        // ];


        $calendars = Calendar::all()
            ->transform(fn ($user) => [
                'id' => $user->id,
                'title' => $user->event_name,
                'start' => $user->start_date,
                'end' => addDays($user->end_date, 1),
                'color' => $user->color,
            ]);
        // 'id'        =>  $this->id,
        // 'title'     =>  $this->event_name,
        // 'start'      =>  $this->start_date,
        // 'end'      =>  $this->end_date,
        return inertia('test/calendar', [
            'events' => $calendars,
        ]);
    })->name('test');


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
    Route::get('/companies/teams/{user}', [CompanyController::class, 'companiesTeams'])->name('companies.teams');

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Teams
    Route::resource('/teams', TeamController::class);

    // Leave Types
    Route::resource('/leaveTypes', LeaveTypeController::class);

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});
