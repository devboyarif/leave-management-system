<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\OrderController;
use App\Http\Controllers\Company\TeamController;
use App\Http\Controllers\Company\InviteController;
use App\Http\Controllers\Company\ReportController;
use App\Http\Controllers\Company\CompanyController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\SettingController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Company\LeaveTypeController;
use App\Http\Controllers\Company\AccountSetupController;
use App\Http\Controllers\Company\LeaveRequestController;

Route::middleware(['auth', 'check.company.role','check.company.setup'])->prefix('company')->name('company.')->group(function () {
    // Employee routes
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/invite', [EmployeeController::class, 'inviteEmployee'])->name('employees.invite');

    // Pricing Plan
    Route::get('/billing', [CompanyController::class, 'billing'])->name('billing');

    // Team routes
    Route::get('/teams/employees', [TeamController::class, 'teamEmployees'])->name('teams.employees');
    Route::resource('/teams', TeamController::class);

    // Leave routes
    Route::resource('/leaveTypes', LeaveTypeController::class);
    Route::resource('/leaveRequests', LeaveRequestController::class);
    Route::post('/status/change', [LeaveRequestController::class, 'statusChange'])->name('leaveRequests.status');
    Route::get('/employee/leave/balance', [LeaveTypeController::class, 'leaveTypeBalance'])->name('employee.leave.type.balance');

    // Holiday routes
    Route::controller(HolidayController::class)->group(function () {
        Route::get('/requested/holidays', 'requestedHolidays')->name('request.holidays');
        Route::post('/requested/holiday/accept', 'requestedHolidaysAccept')->name('request.holidays.accept');
        Route::delete('/requested/holiday/reject/{holiday}', 'requestedHolidaysReject')->name('request.holidays.reject');
        Route::delete('/holiday/destroy/all', 'destroyAllHolidays')->name('holidays.all.destroy');
        Route::post('/holiday/import', 'importHolidays')->name('holidays.import');
    });
    Route::resource('/holidays', HolidayController::class);

    // Orders
    Route::get('/orders/{order}', [OrderController::class, 'orderDetails'])->name('orders.show');

    // Reports
    Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::get('/employee/leave/balance', 'employeeLeaveBalance')->name('employee.leave.balance');
        Route::get('/employee/leave/history', 'employeeLeaveHistory')->name('employee.leave.history');
        Route::get('/employee/leave/history/report', 'employeeLeaveHistoryReport')->name('employee.leave.history.report');
        Route::get('/team/leave/balance', 'teamLeaveBalance')->name('team.leave.balance');
        Route::get('/team/leave/history', 'teamLeaveHistory')->name('team.leave.history');
        Route::get('/team/leave/history/report', 'teamLeaveHistoryReport')->name('team.leave.history.report');
    });

    // Setting
    Route::controller(SettingController::class)->group(function () {
        Route::get('/theme', 'theme')->name('theme.index');
        Route::post('/general/setting', 'generalSetting')->name('general.setting.update');
        Route::post('/theme/update', 'themeUpdate')->name('theme.update');
        Route::put('/workingdays/update', 'workingdaysUpdate')->name('workingdays.update');
    });

    // Configurations & Settings
    Route::controller(SettingController::class)->prefix('settings')->name('settings.')->group(function () {
        Route::get('/general', 'general')->name('general');
        Route::post('/general/setting/update', 'generalSettingUpdate')->name('general.update');
    });

    // Company
    Route::post('switch/{id}', [CompanyController::class, 'switchCompany'])->name('switch');
    Route::get('create', [CompanyController::class, 'createCompany'])->name('create');
    Route::delete('delete', [CompanyController::class, 'deleteCompany'])->name('delete');
});

// Invite Employee
Route::controller(InviteController::class)->prefix('company')->name('company.')->group(function () {
    Route::post('/invite', 'sendInvite')->name('invite.send')->middleware('auth');
    Route::get('invite/accept/{token}', 'acceptInvite')->name('invite.accept');
    Route::post('store/employee/', 'storeEmployee')->name('store.employee');
});

// Account Setup
Route::get('fetch/company/teams', [AccountSetupController::class, 'fetchTeams'])->name('fetch.company.teams');
Route::delete('delete/company/{team}', [AccountSetupController::class, 'deleteTeam'])->name('delete.company.teams');

Route::controller(AccountSetupController::class)->prefix('account/setup')->middleware('auth')->group(function(){
    Route::get('/', 'accountSetup')->name('company.account.setup');
    Route::name('company.account.setup.')->group(function(){
        Route::post('/step1', 'step1')->name('step1');
        Route::post('/step2', 'step2')->name('step2');
        Route::post('/step3', 'step3')->name('step3');
        Route::post('/step4', 'step4')->name('step4');
        Route::post('/step5', 'step5')->name('step5');
        Route::get('/progress', 'progressFetch')->name('progress.fetch');
        Route::put('/progress/{step}', 'progressUpdate')->name('progress.update');
    });
});
