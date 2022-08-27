<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Admin\HasCompanyReport;

class ReportController extends Controller
{
    use HasCompanyReport;

    public function index()
    {
        return inertia('admin/reports/index');
    }
}
