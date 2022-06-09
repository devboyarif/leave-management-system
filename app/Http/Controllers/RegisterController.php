<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyCreateRequest;

class RegisterController extends Controller
{
    public function showRegisterForm()
    {
        $countries = Country::all(['id', 'name']);

        return inertia('auth/register', [
            'countries' => $countries
        ]);
    }

    public function register(CompanyCreateRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        $user->company()->create([
            'country_id' => $request->country,
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            session()->flash('success', 'You have been successfully registered and logged in!');
            return redirect()->intended('/user/dashboard');
        }
    }
}
