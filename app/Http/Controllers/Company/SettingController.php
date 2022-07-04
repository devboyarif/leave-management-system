<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function theme()
    {
        $theme = currentCompany()->theme;

        return inertia('company/setting/theme', [
            'theme' => $theme,
        ]);
    }

    public function themeUpdate(Request $request)
    {
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
}
