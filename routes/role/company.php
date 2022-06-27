<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\TeamController;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Company\EmployeeController;
use App\Http\Controllers\Company\InviteController;
use App\Http\Controllers\Company\LeaveTypeController;
use App\Http\Controllers\Company\LeaveRequestController;

Route::middleware('auth')->prefix('company')->name('company.')->group(function () {
    // Employee routes
    Route::resource('/employees', EmployeeController::class);
    Route::post('/employees/invite', [EmployeeController::class, 'inviteEmployee'])->name('employees.invite');

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
});

Route::controller(InviteController::class)->prefix('company')->name('company.')->group(function () {
    Route::post('/invite', 'sendInvite')->name('invite.send')->middleware('auth');
    Route::get('invite/accept/{token}', 'acceptInvite')->name('invite.accept');
    Route::post('store/employee/', 'storeEmployee')->name('store.employee');
});
