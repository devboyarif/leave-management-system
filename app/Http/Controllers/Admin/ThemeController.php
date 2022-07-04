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
}
