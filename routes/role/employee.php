<?php

use App\Http\Controllers\Employee\LeaveRequestController;
use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
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
        Route::delete('/leave/request/{leave_request}', 'destroy')->name('leave.request.delete');
    });
});
