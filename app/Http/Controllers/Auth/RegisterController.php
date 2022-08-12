<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\Country;
use App\Models\Holiday;
use App\Traits\HasCountry;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyCreateRequest;
use App\Notifications\Admin\NewCompanyJoined;

class RegisterController extends Controller
{
    use HasCountry;

    public function showRegisterForm()
    {
        $countries = Country::all(['id', 'name']);

        return inertia('auth/register', [
            'countries' => $countries
        ]);
    }

    public function register(CompanyCreateRequest $request)
    {
        // creating user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
        ]);

        // creating company
        $company = $user->company()->create([
            'country_id' => $request->country,
        ]);

        // store official holidays
        if ($request->import_official_holidays) {
            $country = Country::findOrFail($request->country);
            $code = $this->getCountryCode($country->code);

            importHolidays($company->id, $code);
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            session()->flash('success', 'You have been successfully registered and logged in!');
            return redirect()->intended('/user/dashboard');
        }
    }
}
