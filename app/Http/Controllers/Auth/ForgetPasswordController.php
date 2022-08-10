<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Notifications\ResetPassword;

class ForgetPasswordController extends Controller
{

    public function passwordEmail()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard');
        }
        return inertia('auth/email');
    }

    public function sendCode(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
        ]);

        $user = User::where('email', $request->email)->first();
        $code = rand(1000, 9999);

        if (!$user) {
            session()->flash('error', 'Email not found');
            return back();
        }

        if (checkMailConfig()) {
            $user->notify(new ResetPassword($code));
        } else {
            session()->flash('error', 'Mail not configured');
            return back();
        }

        $user->update(['code' => $code]);

        session()->flash('success', 'We have emailed your password reset code');
        return inertia('auth/checkCode', ['email' => $request->email]);
    }

    public function checkCode(Request $request)
    {
        $this->validate($request, [
            'code' => 'required'
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user->code == $request->code) {
            return inertia('auth/resetPassword', ['email' => $request->email]);
        }

        session()->flash('error', 'Invalid code');
        return inertia('auth/checkCode', ['email' => $request->email]);
    }

    public function passwordReset(Request $request)
    {
        $this->validate($request, [
            'password' => 'required|string|min:6|confirmed',
        ]);
        return $request;
    }
}
