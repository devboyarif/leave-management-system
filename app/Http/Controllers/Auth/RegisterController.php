<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Traits\HasCountry;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyCreateRequest;

class RegisterController extends Controller
{
    use HasCountry;

    public function showRegisterForm()
    {
        return inertia('auth/register');
    }

    public function register(CompanyCreateRequest $request)
    {
        // creating user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            return redirect()->intended('/account/setup');
        }
    }
}
