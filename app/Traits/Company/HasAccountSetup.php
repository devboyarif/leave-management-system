<?php

namespace App\Traits\Company;

use App\Models\User;
use App\Models\Country;
use App\Traits\HasCountry;

trait HasAccountSetup
{
    use HasCountry;

    public function saveStep1($request){
        $request->validate([
            'company_name' => 'required',
            'company_email' => 'required|unique:companies,company_email',
            'country' => 'required',
            'team_size' => 'required',
        ]);

        $user = auth()->user();

        // Create a new company
        $company = $user->companies()->create([
            'company_name' => $request->company_name,
            'company_email' => $request->company_email,
            'country_id' => $request->country,
            'team_size_id' => $request->team_size,
        ]);
        $user->update(['current_company_id' => $company->id]);

        // store official holidays
        if ($request->import_official_holidays) {
            $country = Country::findOrFail($request->country);
            $code = $this->getCountryCode($country->code);

            importHolidays($company->id, $code);
        }
    }

    public function saveStep2($request){
        $request->validate([
            'names.*' => 'required',
        ]);

        $company = currentCompany();
        $teams = $request->names;

        if ($teams) {
            foreach ($teams as $name) {
                if ($name) {
                    $company->teams()->create([
                        'name' => $name,
                    ]);
                }
            }
        }

    }

    public function saveStep3($request){
        $request->validate([
            'emails.*' => 'required',
            'teams.*' => 'required',
        ]);

        $company = currentCompany();
        $emails = $request->emails;
        $teams = $request->teams;

        if ($emails && $teams) {
            foreach ($emails as $key => $email) {
                if ($email && $teams[$key]) {
                    sendInvite($company->id,$email, $teams[$key]);
                }
            }
        }


        // return [
        //     $emails,
        //     $teams,
        // ];

        // sendInvite($company->id,$request->email, $request->team_id);

        // $social_medias = $request->social_media;
        // $urls = $request->url;



    }

    public function saveStep4($request){
        //
    }

    public function saveStep5($request){
        //
    }
}
