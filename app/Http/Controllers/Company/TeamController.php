<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Models\Employee;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        // $team_query = Team::query();

        // if (request('user_id') && request('user_id') != 'all') {
        //     $team_query->where('company_id', getCompany(request('user_id'))->id);
        // }

        // $teams = $team_query->with('employees.user', 'company.user')->latest()->paginate(10);
        $teams = Team::where('company_id', currentCompany()->id)->get(['id', 'name', 'slug']);
        $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')->where('company_id', currentCompany()->id)->get();

        return inertia('company/teams', [
            'teams' => $teams,
            'employees' => $employees,
        ]);
    }

    public function store(TeamSaveRequest $request)
    {
        $company = Company::where('user_id', $request->user_id)->firstOrFail();

        $company->teams()->create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Team created successfully!');
        return back();
    }

    public function update(TeamSaveRequest $request, Team $team)
    {
        $company = Company::where('user_id', $request->user_id)->firstOrFail();

        $team->update([
            'name' => $request->name,
            'company_id' => $company->id,
        ]);

        session()->flash('success', 'Team updated successfully!');
        return back();
    }

    public function destroy(Team $team)
    {
        $team->delete();

        session()->flash('success', 'Team deleted successfully!');
        return back();
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
