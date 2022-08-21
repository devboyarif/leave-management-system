<?php

namespace App\Http\Controllers\Company;

use App\Models\Team;
use App\Models\Invite;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Mail\Company\InviteSendMail;
use Illuminate\Support\Facades\Mail;

class TeamController extends Controller
{
    use HasSubscription;

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
        // Check if the user is limited to create employees
        if ($this->checkTeamLimitation()) {
            session()->flash('error', __('You have reached the maximum number of teams'));
            return back();
        }

        $company = currentCompany();
        $request->validate([
            'name' => 'required',
        ]);

        if (Team::where('company_id', $company->id)->where('name', $request->name)->exists()) {
            session()->flash('error', 'Team already exists!');
            return back();
        }

        $team = Team::create([
            'name' => $request->name,
            'company_id' => $company->id,
        ]);

        if (isset($request->emails) && count($request->emails)) {
            foreach ($request->emails as $email) {
                if ($email != null) {
                    $token = Str::random(60);

                    if (!Invite::whereToken($token)->exists()) {
                        $invite = Invite::create([
                            'team_id' => $team->id,
                            'email' => $email,
                            'token' => $token,
                            'company_id' => $company->id,
                        ]);
                    } else {
                        $token = Str::random(100);
                        $invite = Invite::create([
                            'team_id' => $team->id,
                            'email' => $email,
                            'token' => $token,
                            'company_id' => $company->id,
                        ]);
                    }

                    // send the email
                    Mail::to($email)->send(new InviteSendMail($invite));
                }
            }
        }

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
