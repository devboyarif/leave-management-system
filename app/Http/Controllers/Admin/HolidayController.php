<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\User;
use Illuminate\Http\Request;

class HolidayController extends Controller
{
    public function index()
    {
        $users = User::roleCompany()->with('company.country')->withCount('holidays')->latest()->paginate(10);

        return inertia('admin/holiday/index', [
            'users' => $users,
        ]);
    }

    public function show(User $holiday)
    {
        $user = $holiday;
        $company = Company::where('user_id', $user->id)->firstOrFail();
        $holidays = Holiday::where('company_id', $company->id)->oldest('start')->get()->transform(function ($date) {
            $date->format_start_date = formatTime($date->start, 'D d M');
            $date->format_end_date = formatTime($date->end, 'D d M');
            return $date;
        });

        // return [
        //     'user' => $user,
        //     'company' => $company,
        //     'holidays' => $holidays,
        // ];

        return inertia('admin/holiday/show', [
            'user' => $user,
            'company' => $company,
            'holidays' => $holidays,
        ]);


        return $user;
        $users = User::roleCompany()->with('company.country')->withCount('holidays')->latest()->paginate(10);

        return inertia('admin/holiday/index', [
            'users' => $users,
        ]);
    }
}
