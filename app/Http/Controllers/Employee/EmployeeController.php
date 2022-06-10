<?php

namespace App\Http\Controllers\Employee;

use App\Models\Company;
use App\Models\Holiday;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\HolidayRequest;
use App\Http\Controllers\Controller;

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

    public function teams()
    {
        $team = currentUser()->employee->team;
        $employeeUsers = Employee::with('user:id,name,email,avatar', 'team:id,name')
            ->where('team_id', $team->id)
            ->get();

        return inertia('employee/teams', [
            'team' => $team,
            'employeeUsers' => $employeeUsers,
        ]);
    }
}
