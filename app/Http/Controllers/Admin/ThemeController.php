<?php

namespace App\Http\Controllers\Admin;

use App\Models\Theme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ThemeController extends Controller
{
    public function theme()
    {
        $theme = Theme::first();

        return inertia('admin/setting/theme', [
            'theme' => $theme,
        ]);
    }

    public function adminThemeUpdate(Request $request)
    {
        $theme = Theme::first();

        $theme->update([
            "primary_color" => $request->primary_color ?? $theme->primary_color,
            "hover_color" => $request->hover_color ?? $theme->hover_color,
            "secondary_color" => $request->secondary_color ?? $theme->secondary_color,
            "success_color" => $request->success_color ?? $theme->success_color,
            "info_color" => $request->info_color ?? $theme->info_color,
            "warning_color" => $request->warning_color ?? $theme->warning_color,
            "danger_color" => $request->danger_color ?? $theme->danger_color,
        ]);

        session(['theme' => $theme]);
        session()->flash('success', 'Theme updated successfully.');
        return redirect()->back();
    }

    public function websiteThemeUpdate(Request $request)
    {
        $theme = Theme::first();

        $theme->update([
            "website_primary_color" => $request->website_primary_color ?? $theme->website_primary_color,
            "website_secondary_color" => $request->website_secondary_color ?? $theme->website_secondary_color,
            "website_heading_text_color" => $request->website_heading_text_color ?? $theme->website_heading_text_color,
            "website_body_text_color" => $request->website_body_text_color ?? $theme->website_body_text_color,
        ]);

        session(['theme' => $theme]);
        session()->flash('success', 'Theme updated successfully.');
        return redirect()->back();
    }
}
