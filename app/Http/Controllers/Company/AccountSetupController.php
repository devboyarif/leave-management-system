<?php

namespace App\Http\Controllers\Company;

use App\Models\Team;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\Company\HasAccountSetup;

class AccountSetupController extends Controller
{
    use HasAccountSetup;

    public function accountSetup(){
        return inertia('company/setup/index');
    }

    public function step1(Request $request){
        try {
            $this->saveStep1($request);
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }

    }

    public function step2(Request $request){
        try {
            $this->saveStep2($request);
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }
    }

    public function step3(Request $request){
        try {
            $this->saveStep3($request);
            session()->flash('success', 'Invite Sent');
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }
    }

    public function step4(Request $request){
        try {
            $this->saveStep4($request);
            return back();
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }
    }

    public function step5(){
        try {
            $user = auth()->user();
            $user->update(['is_opening_setup_complete' => 1]);
            return redirect_to('dashboard');
        } catch (\Throwable $th) {
            session()->flash('error', config('app.debug') ? $th->getMessage():'Something went wrong');
            return back();
        }
    }

    public function fetchTeams()
    {
        return currentCompany()->teams;
    }

    public function deleteTeam(Team $team)
    {
        $team->delete();

        session()->flash('success', 'Team deleted');
        return back();
    }

    public function inviteEmployee(Request $request)
    {
        return $request;

        session()->flash('success', 'Team deleted');
        return back();
    }
}
