<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return inertia('test/login');
    return redirect()->route('dashboard');
    return inertia('index');
});

include(base_path('routes/test.php'));
include(base_path('routes/auth.php'));
include(base_path('routes/admin.php'));
include(base_path('routes/company.php'));
include(base_path('routes/employee.php'));
