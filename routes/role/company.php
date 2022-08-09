<?php

use App\Http\Controllers\Company\CompanyController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\TeamController;
use App\Http\Controllers\Company\InviteController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\SettingController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Company\LeaveTypeController;
use App\Http\Controllers\Company\LeaveRequestController;
use App\Http\Controllers\Company\ReportController;

Route::middleware(['auth','check.company.role'])->prefix('company')->name('company.')->group(function () {
    // Employee routes
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/invite', [EmployeeController::class, 'inviteEmployee'])->name('employees.invite');

    // Pricing Plan
    Route::get('/orders', [CompanyController::class, 'orders'])->name('orders.index');
    Route::get('/pricing/plan', [CompanyController::class, 'plan'])->name('plan');

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
    });
    Route::resource('/holidays', HolidayController::class);

    // Reports
    Route::controller(ReportController::class)->prefix('reports')->name('reports.')->group(function(){
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
        Route::post('/theme/update', 'themeUpdate')->name('theme.update');
    });
});

Route::controller(InviteController::class)->prefix('company')->name('company.')->group(function () {
    Route::post('/invite', 'sendInvite')->name('invite.send')->middleware('auth');
    Route::get('invite/accept/{token}', 'acceptInvite')->name('invite.accept');
    Route::post('store/employee/', 'storeEmployee')->name('store.employee');
});
