<?php

namespace App\Http\Controllers\Company;

use App\Models\User;
use App\Models\Invite;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Mail\Company\InviteSendMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InviteController extends Controller
{
    use HasSubscription;

    public function sendInvite(Request $request)
    {
        // Check if the user is limited to create employees
        if ($this->checkEmployeesLimitation()) {
            session()->flash('error', __('You have reached the maximum number of employees'));
            return back();
        }

        $request->validate([
            'email' => 'required|email',
            'team_id' => 'required|exists:teams,id',
        ], [
            'team_id.required' => 'The team field is required.',
        ]);

        $data = $request->only(['team_id', 'email']);
        $data['token'] = Str::random(60);
        $data['company_id'] = currentCompany()->id;

        if (!Invite::whereToken($data['token'])->exists()) {
            $invite = Invite::create($data);
        } else {
            $data['token'] = Str::random(100);
            $invite = Invite::create($data);
        }

        // send the email
        Mail::to($request->email)->send(new InviteSendMail($invite));

        session()->flash('success', 'Invite sent successfully');
        return back();
    }

    public function acceptInvite($token)
    {
        $invite = Invite::whereToken(request('token'))->firstOrFail();

        if ($invite->status == Invite::STATUS_ACCEPTED) {
            session()->flash('error', 'This invite has already been accepted.');
            return redirect()->route('login');
        }

        return inertia('company/employeeRegister', [
            'token' => $invite->token,
        ]);
    }

    public function storeEmployee(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'password' => 'required|confirmed|min:8',
            'terms_confirmed' => 'required',
        ]);

        $invite = Invite::whereToken(request('token'))->firstOrFail();

        // check if the invite has already been accepted
        if (User::whereEmail($invite->email)->exists()) {
            session()->flash('error', 'This email is already registered.Please login.');
            return redirect()->route('login');
        }

        // create the user
        $user = User::create([
            'name' => $request->name,
            'email' => $invite->email,
            'role' => User::ROLE_EMPLOYEE,
            'password' => bcrypt($request->password),
        ]);


        // create the employee
        $user->employee()->create([
            'company_id' => $invite->company_id,
            'team_id' => $invite->team_id,
        ]);

        // mark as accepted the invite
        $invite->update(['status' => Invite::STATUS_ACCEPTED]);

        // login the user
        if (Auth::attempt(['email' => $user->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            session()->flash('success', 'Account has been created successfully and your are now logged in!');
            return redirect()->intended('/user/dashboard');
        }
    }
}
