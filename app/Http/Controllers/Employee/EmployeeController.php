<?php

namespace App\Http\Controllers\Employee;

use App\Models\Team;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Models\HolidayRequest;
use App\Http\Controllers\Controller;
use App\Notifications\Company\NewHolidayRequest;

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

        $employee = currentEmployee();

        HolidayRequest::create([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'note' => $request->note,
            'employee_id' => $employee->id,
            'company_id' => $employee->company_id,
        ]);

        // Notification for company
        $user = $employee->company->user ?? null;
        isset($user) ? $user->notify(new NewHolidayRequest($employee->company_id)) : '';

        session()->flash('success', 'Holiday request sent successfully!');
        return back();
    }

    public function teams()
    {
        $company = currentUser()->employee;
        $teams = Team::where('company_id', $company->company_id)->get(['id', 'name', 'slug']);
        $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')->where('company_id', $company->company_id)->get();

        return inertia('employee/teams', [
            'teams' => $teams,
            'employees' => $employees,
        ]);
    }

    public function teamEmployees(Request $request)
    {
        if ($request->team && $request->team != 'all') {
            $team = Team::whereSlug($request->team)->firstOrFail();
            $employees = $team->employees()->with('user:id,name,email,avatar', 'team:id,name')->get();
        } else {
            $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')->where('company_id', currentCompany()->id)->get();
        }

        return [
            'employees' => $employees,
        ];
    }
}
