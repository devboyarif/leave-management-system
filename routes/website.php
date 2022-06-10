<?php

use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return 123;
//     // return redirect()->route('dashboard');
//     // return inertia('index');
// });

Route::get('/', [WebsiteController::class, 'index'])->name('index');
