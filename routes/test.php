<?php

use App\Http\Controllers\Admin\UpgradeController;
use App\Http\Controllers\TestController;
use App\Models\Language;
use Illuminate\Support\Facades\Route;

Route::get('/testt', [TestController::class, 'index']);

Route::get('/test', function () {
    return auth()->user()->companies;
    return Language::where('status', 1)->get(['id', 'name', 'code']);
    return view('system.app_status');
})->name('test');

Route::post('update/system', [UpgradeController::class, 'updateSystem'])->name('update.system');
