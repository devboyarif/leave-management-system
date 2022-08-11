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
        return redirect()->route('password.reset.form', $user->email);
    }

    public function passwordResetForm($email)
    {
        return inertia('auth/reset', compact('email'));
    }

    public function passwordReset(Request $request)
    {
        $this->validate($request, [
            'email' => 'required|string|email',
            'code' => 'required|numeric',
            'password' => 'required|string',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user) {
            session()->flash('error', 'Email not found');
            return back();
        }

        if ($user->code != $request->code) {
            session()->flash('error', 'Code mismatch');
            return back();
        }

        $user->update(['password' => bcrypt($request->password)]);

        session()->flash('success', 'Password changed successfully');
        return redirect()->route('login');
    }
}
