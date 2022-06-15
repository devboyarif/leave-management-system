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
        $teams = Team::select('id', 'name', 'company_id')
            ->with('employees.user')
            ->where('company_id', currentCompany()->id)
            ->latest()
            ->paginate(10);

        return inertia('company/teams', [
            'teams' => $teams,
        ]);
    }

    public function store(Request $request)
    {
        $company = currentCompany();
        $request->validate([
            'name' => 'required',
        ]);

        if (Team::where('company_id', $company->id)->where('name', $request->name)->exists()) {
            session()->flash('error', 'Team already exists!');
            return back();
        }

        $company->teams()->create([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Team created successfully!');
        return back();
    }

    public function update(Request $request, Team $team)
    {
        $company = currentCompany();
        $request->validate([
            'name' => 'required',
        ]);

        if (Team::where('company_id', $company->id)->whereName($request->name)->where('id', '!=', $team->id)->exists()) {
            session()->flash('error', 'Team already exists!');
            return back();
        }

        $team->update([
            'name' => $request->name,
        ]);

        session()->flash('success', 'Team updated successfully!');
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
            $team = Team::whereSlug($request->team)->where('company_id', currentCompany()->id)->firstOrFail();
            $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')
                ->where('team_id', $team->id)
                ->where('company_id', currentCompany()->id)
                ->get();
        } else {
            $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')
                ->where('company_id', currentCompany()->id)
                ->get();
        }

        return [
            'employees' => $employees,
        ];
    }
}
