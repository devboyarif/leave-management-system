<?php

namespace App\Http\Controllers\Employee;

use App\Models\Company;
use App\Models\Holiday;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\HolidayRequest;

class EmployeeController extends Controller
{
    public function holidays()
    {
        $user = getCompanyUserByEmployeeUser(currentUserId());
        $company = Company::where('user_id', $user->id)->firstOrFail();
        $holidays = Holiday::where('company_id', $company->id)
            ->oldest('start')
            ->get()
            ->transform(function ($date) {
                $date->format_start_date = formatTime($date->start, 'D d M');
                $date->format_end_date = formatTime($date->end, 'D d M');
                return $date;
            });


        return inertia('employee/holidays', [
            'user' => $user,
            'company' => $company,
            'holidays' => $holidays,
        ]);
    }

    public function storeHolidayRequest(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'start' => 'required',
            'end' => 'required',
            'note' => 'required',
        ]);

        $request = $request->all();
        $request['employee_id'] = currentUserId();
        HolidayRequest::create($request);

        session()->flash('success', 'Holiday request sent successfully!');
        return back();
    }
}
