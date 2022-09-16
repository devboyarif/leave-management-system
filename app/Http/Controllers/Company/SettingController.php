<?php

namespace App\Http\Controllers\Company;

use App\Models\Country;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use HasSubscription;

    public function general()
    {
        $data['company'] = currentCompany();
        $data['user'] = auth()->user();
        $data['workingdays'] = $data['company']->workingDays;
        $data['theme'] = $data['company']->theme;
        $data['countries'] = Country::all(['id', 'name']);

        return inertia('company/settings', $data);
    }

    public function theme()
    {
        $theme = currentCompany()->theme;

        return inertia('company/setting/theme', [
            'theme' => $theme,
        ]);
    }

    public function generalSetting(Request $request)
    {
        $company = currentCompany();

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => "required|string|email|max:255|unique:companies,company_email, $company->id",
        ]);

        $data['company_name'] = $request->name;
        $data['company_email'] = $request->email;

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['company_logo'] = $url;
        }

        $company->update($data);


        session()->flash('success', 'Company updated successfully!');
        return back();
        return $request;
    }

    public function themeUpdate(Request $request)
    {
        // Check if the user has permission to update theme
        if ($this->checkCustomThemeAccess()) {
            session()->flash('error', __("Upgrade your plan to use this feature"));
            return back();
        }

        $theme = currentCompany()->theme;

        $theme->update([
            "primary_color" => $request->primary_color ?? $theme->primary_color,
            "hover_color" => $request->hover_color ?? $theme->hover_color,
            "secondary_color" => $request->secondary_color ?? $theme->secondary_color,
            "success_color" => $request->success_color ?? $theme->success_color,
            "info_color" => $request->info_color ?? $theme->info_color,
            "warning_color" => $request->warning_color ?? $theme->warning_color,
            "danger_color" => $request->danger_color ?? $theme->danger_color,
        ]);

        session(['company_theme' => $theme]);
        session()->flash('success', 'Theme updated successfully.');
        return redirect()->back();
    }

    public function workingdaysUpdate(Request $request)
    {
        $company = currentCompany();
        $company->workingDays()->update([
            "monday" => $request->monday ? true : false,
            "tuesday" => $request->tuesday ? true : false,
            "wednesday" => $request->wednesday ? true : false,
            "thursday" => $request->thursday ? true : false,
            "friday" => $request->friday ? true : false,
            "saturday" => $request->saturday ? true : false,
            "sunday" => $request->sunday ? true : false,
        ]);

        session()->flash('success', 'Working days updated successfully.');
        return back();
    }
}
