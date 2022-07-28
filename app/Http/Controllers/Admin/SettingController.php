<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function general()
    {
        return inertia('admin/setting/general');
    }

    public function cms()
    {
        return inertia('admin/setting/cms');
    }

    public function currency()
    {
        return inertia('admin/setting/currency');
    }

    public function payment()
    {
        return inertia('admin/setting/payment');
    }

    public function seo()
    {
        return inertia('admin/setting/seo');
    }

    public function smtp()
    {
        return inertia('admin/setting/smtp');
    }
}
