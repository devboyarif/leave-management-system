<?php

use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('employee')->name('employee.')->group(function () {
    Route::controller(EmployeeController::class)->group(function () {
        Route::get('/holidays', 'holidays')->name('holidays');
        Route::post('/create/holiday/request', 'storeHolidayRequest')->name('holiday.request.create');
        Route::get('/teams', 'teams')->name('teams');
        Route::get('/leave/request', 'leaveRequest')->name('leave.request');
        Route::post('/leave/request/send', 'leaveRequestSend')->name('leave.request.send');
        Route::get('/teams/employees', 'teamEmployees')->name('teams.employees');
    });
});
