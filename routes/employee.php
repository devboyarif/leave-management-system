<?php

use App\Http\Controllers\Employee\EmployeeController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->prefix('employee')->group(function () {
    Route::get('/holidays', [EmployeeController::class, 'holidays'])->name('employee.holidays');
});
