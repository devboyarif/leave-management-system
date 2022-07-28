<?php

use App\Http\Controllers\Admin\BlogController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\PlanController;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Admin\ThemeController;
use App\Http\Controllers\Admin\GlobalController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\HolidayController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\FaqController;
use App\Http\Controllers\Admin\LanguageController;
use App\Http\Controllers\Admin\LeaveTypeController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\LeaveRequestController;
use App\Http\Controllers\Admin\TestimonialController;

Route::middleware(['auth', 'check.admin.role'])->prefix('admin')->group(function () {
    Route::get('/about', function () {
        return inertia('about');
    })->name('about');

    Route::get('/contact', function () {
        return inertia('contact');
    })->name('contact');

    // =========================================================================
    // ===================Users Routes========================================
    // ========================================================================

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::controller(CompanyController::class)->group(function () {
        Route::get('/companies/teams/{company}', 'companiesTeams')->name('companies.teams');
        Route::get('/companies/leaveTypes/{user}', 'companiesLeaveTypes')->name('companies.leaveTypes');
        Route::get('/companies/employees/{user}', 'companiesEmployees')->name('companies.employees');
    });

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Teams
    Route::resource('/teams', TeamController::class);

    // =========================================================================
    // ===================Leave and Subscription Routes========================
    // ========================================================================

    // Plans
    Route::resource('/plans', PlanController::class);
    Route::controller(PlanController::class)->group(function () {
        Route::put('/plans/set-recommended-plan/{plan}', 'setRecommended')->name('plans.set.recommended.plan');
        Route::put('/plans/set-default-plan/{plan}', 'setDefault')->name('plans.set.default.plan');
    });

    // Order
    Route::get('/admin/orders', [OrderController::class, 'orders'])->name('orders.index');

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


    // =========================================================================
    // ===================Others Routes========================================
    // ========================================================================
    Route::resource('/posts', BlogController::class);
    Route::resource('/faqs', FaqController::class);
    Route::resource('/testimonials', TestimonialController::class);

    // =========================================================================
    // ===================Setting Routes========================================
    // ========================================================================

    // Languages Routes
    Route::controller(LanguageController::class)->group(function () {
        Route::get('/setting/languages', 'index')->name('languages.index');
        Route::post('/setting/languages', 'store')->name('languages.store');
        Route::put('/setting/languages/{lang}', 'update')->name('languages.update');
        Route::delete('/setting/languages/{lang}', 'destroy')->name('languages.destroy');
        Route::get('/setting/languages/translation/{lang}', 'translationEdit')->name('languages.translation.edit');
        Route::put('/setting/languages/translation/{lang}', 'translationUpdate')->name('languages.translation.update');
        Route::put('/setting/languages/status/{lang}', 'statusUpdate')->name('languages.status.update');
        Route::get('/setting/languages/translate/single', 'singleTranslate')->name('languages.translate');
        Route::get('/setting/languages/translate/all', 'allTranslate')->name('languages.translate.all');
    });

    // Themes Routes
    Route::controller(ThemeController::class)->group(function () {
        Route::get('/setting/theme', 'theme')->name('theme');
        Route::post('/setting/theme', 'adminThemeUpdate')->name('theme.admin.update');
        Route::post('/setting/website/theme', 'websiteThemeUpdate')->name('theme.website.update');
    });

    // Configurations & Settings
    Route::controller(SettingController::class)->prefix('settings')->group(function () {
        Route::get('/general', 'general')->name('settings.general');
        Route::get('/cms', 'cms')->name('settings.cms');
        Route::get('/currency', 'currency')->name('settings.currency');
        Route::get('/payment', 'payment')->name('settings.payment');
        Route::get('/seo', 'seo')->name('settings.seo');
        Route::get('/smtp', 'smtp')->name('settings.smtp');
    });
});

// Profile & Settings
Route::controller(UserController::class)->middleware('auth')->group(function () {
    Route::get('/profile', 'profile')->name('user.profile');
    Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
    Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
});

Route::controller(GlobalController::class)->group(function () {
    Route::get('/diff/between/days', 'diffBetweenDays')->name('difference.between.days');
    Route::get('/user/notifications', 'notifications')->name('notifications.index');
    Route::get('/get/translated/message', 'getTranslatedMessage')->name('get.translated.message');
    Route::get('/error/403', 'error403')->name('error.403');
});
