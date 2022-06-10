<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Company\HolidayController;
use App\Http\Controllers\Employee\EmployeeController;

Route::middleware('auth')->prefix('company')->name('company.')->group(function () {
    Route::resource('/holidays', HolidayController::class);
    // Route::controller(EmployeeController::class)->group(function () {
    //     Route::get('/holidays', 'holidays')->name('holidays');
    //     Route::post('/create/holiday/request', 'storeHolidayRequest')->name('holiday.request.create');
    // });

    Route::controller(HolidayController::class)->group(function () {
        Route::get('/requested/holidays', 'requestedHolidays')->name('request.holidays');
        Route::post('/requested/holiday/accept', 'requestedHolidaysAccept')->name('request.holidays.accept');
        Route::delete('/requested/holiday/reject/{holiday}', 'requestedHolidaysReject')->name('request.holidays.reject');
    });
});
