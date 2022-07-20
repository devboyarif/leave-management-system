<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\LeaveRequestController;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/about', function () {
        return inertia('about');
    })->name('about');

    Route::get('/contact', function () {
        return inertia('contact');
    })->name('contact');

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies/teams/{user}', 'companiesTeams')->name('companies.teams');
        Route::get('/companies/leaveTypes/{user}', 'companiesLeaveTypes')->name('companies.leaveTypes');
        Route::get('/companies/employees/{user}', 'companiesEmployees')->name('companies.employees');
    });

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Teams
    Route::resource('/teams', TeamController::class);

    // Plans
    Route::resource('/plans', PlanController::class);

    // Leave Types & Request
    Route::resource('/leaveTypes', LeaveTypeController::class);
    Route::resource('/leaveRequests', LeaveRequestController::class);
    Route::post('/status/change', [LeaveRequestController::class, 'statusChange'])->name('leaveRequests.status');
    Route::get('/companies/employee/leave/balance', [LeaveTypeController::class, 'leaveTypeBalance'])->name('companies.employee.leave.type.balance');

    // Holidays
    Route::resource('/holidays', HolidayController::class);
    Route::controller(HolidayController::class)->group(function () {
        Route::get('/requested/holidays/{company}', 'requestedHolidays')->name('request.holidays.index');
        Route::post('/requested/holiday/accept', 'requestedHolidaysAccept')->name('request.holidays.accept');
        Route::delete('/requested/holiday/reject/{holiday}', 'requestedHolidaysReject')->name('request.holidays.reject');
    });

    // Languages
    Route::controller(LanguageController::class)->group(function () {
        Route::get('/languages', 'index')->name('languages.index');
        Route::post('/languages', 'store')->name('languages.store');
        Route::put('/languages/{lang}', 'update')->name('languages.update');
        Route::delete('/languages/{lang}', 'destroy')->name('languages.destroy');
        Route::get('/languages/translation/{lang}', 'translationEdit')->name('languages.translation.edit');
        Route::put('/languages/translation/{lang}', 'translationUpdate')->name('languages.translation.update');
        Route::put('/languages/status/{lang}', 'statusUpdate')->name('languages.status.update');
        Route::get('/languages/translate/single', 'singleTranslate')->name('languages.translate');
        Route::get('/languages/translate/all', 'allTranslate')->name('languages.translate.all');
    });

    // Themes
    Route::controller(ThemeController::class)->group(function () {
        Route::get('/setting/theme', 'theme')->name('theme');
        Route::post('/setting/theme', 'adminThemeUpdate')->name('theme.admin.update');
        Route::post('/setting/website/theme', 'websiteThemeUpdate')->name('theme.website.update');
        // Route::post('/languages', 'store')->name('languages.store');
        // Route::put('/languages/{lang}', 'update')->name('languages.update');
        // Route::delete('/languages/{lang}', 'destroy')->name('languages.destroy');
        // Route::get('/languages/translation/{lang}', 'translationEdit')->name('languages.translation.edit');
        // Route::put('/languages/translation/{lang}', 'translationUpdate')->name('languages.translation.update');
        // Route::put('/languages/status/{lang}', 'statusUpdate')->name('languages.status.update');
        // Route::get('/languages/translate/single', 'singleTranslate')->name('languages.translate');
        // Route::get('/languages/translate/all', 'allTranslate')->name('languages.translate.all');
    });

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});

Route::controller(GlobalController::class)->group(function () {
    Route::get('/diff/between/days', 'diffBetweenDays')->name('difference.between.days');
    Route::get('/user/notifications', 'notifications')->name('notifications.index');
    Route::get('/get/translated/message', 'getTranslatedMessage')->name('get.translated.message');
});
