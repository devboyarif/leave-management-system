<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function adminTheme()
    {
        return inertia('admin/setting/theme/adminTheme');
        return 54656;
    }
}
