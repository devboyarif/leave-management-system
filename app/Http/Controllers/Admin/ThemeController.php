<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ThemeController extends Controller
{
    public function adminTheme()
    {
        // return currentCompany();
        // return $theme = currentCompany()->theme;

        return inertia('admin/setting/theme/adminTheme', []);
    }
}
