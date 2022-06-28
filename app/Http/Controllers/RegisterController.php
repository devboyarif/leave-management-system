<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Country;
use App\Models\Holiday;
use App\Traits\HasCountry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CompanyCreateRequest;

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
        $country = Country::findOrFail($request->country);
        $code = $this->getCountryCode($country->code);

        try {
            $holidays = getHolidays($code);
        } catch (\Throwable $th) {
            // throw $th;
        }

        if (isset($holidays) && count($holidays)) {
            for ($i = 0; $i < count($holidays); $i++) {
                $holiday_data[] = [
                    'company_id' => $company->id,
                    'title' => $holidays[$i]['title'],
                    'start' => $holidays[$i]['start'],
                    'end' => $holidays[$i]['end'],
                    'days' => diffBetweenDays($holidays[$i]['start'], $holidays[$i]['end']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $holiday_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

            foreach ($holiday_chunks as $country) {
                Holiday::insert($country);
            }
        }

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $request->session()->regenerate();

            session()->flash('success', 'You have been successfully registered and logged in!');
            return redirect()->intended('/user/dashboard');
        }
    }
}
