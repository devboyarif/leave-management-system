<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Employee\ReportController;
use App\Http\Controllers\Employee\EmployeeController;
use App\Http\Controllers\Employee\LeaveRequestController;

Route::middleware(['auth','check.employee.role'])->prefix('employee')->name('employee.')->group(function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/holidays', 'holidays')->name('holidays');
        Route::post('/create/holiday/request', 'storeHolidayRequest')->name('holiday.request.create');
        Route::get('/teams', 'teams')->name('teams');
        Route::get('/teams/employees', 'teamEmployees')->name('teams.employees');
    });

    Route::controller(LeaveRequestController::class)->group(function () {
        Route::get('/leave/requests', 'index')->name('leave.request.index');
        Route::get('/leave/request', 'create')->name('leave.request.create');
        Route::post('/leave/request/create', 'store')->name('leave.request.store');
        Route::get('/leave/request/{leave_request}/edit', 'edit')->name('leave.request.edit');
        Route::put('/leave/request/update/{leave_request}', 'update')->name('leave.request.update');
        Route::get('/leave/{leaveType}/balance', 'leaveTypeBalance')->name('leave.type.balance');
    });

      // Reports
      Route::controller(ReportController::class)->prefix('reports')->group(function(){
        Route::get('/', 'index')->name('reports');
        Route::get('/details', 'details')->name('reports.details');
    });
});
