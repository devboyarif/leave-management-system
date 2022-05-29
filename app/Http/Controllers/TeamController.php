<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use App\Http\Requests\TeamCreateRequest;
use App\Http\Requests\TeamSaveRequest;
use App\Http\Requests\TeamUpdateRequest;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $team_query = Team::query();

        if (request('user_id') && request('user_id') != 'all') {
            $team_query->where('company_id', getCompany(request('user_id'))->id);
        }

        $teams = $team_query->with('company.user')->latest()->paginate(10);

        $users = User::where('role', 'company')->get();

        return inertia('team/index', [
            'teams' => $teams,
            'users' => $users,
            'filterUserId' => request('user_id'),
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
}
