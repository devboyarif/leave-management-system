<?php

use App\Http\Controllers\Admin\UpgradeController;
use App\Http\Controllers\TestController;
use Illuminate\Support\Facades\Route;

Route::get('/testt', [TestController::class, 'index']);

Route::get('/test', function () {
    return view('system.app_status');
})->name('test');

Route::post('update/system', [UpgradeController::class, 'updateSystem'])->name('update.system');
