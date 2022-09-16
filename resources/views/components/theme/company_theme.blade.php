@php
    $user = auth()->user();

    if ($user->role == 'owner' && $user->current_company_id) {
        if (!session()->has('company_theme')) {
            session(['company_theme' => currentCompany()->theme]);
            // session(['company_theme' => auth()->user()->companies->theme]);
        }

        $theme = session('company_theme');
    } else if($user->role == 'employee') {
        if (!session()->has('company_theme')) {
            session(['company_theme' => auth()->user()->employee->company->theme]);
        }

        $theme = session('company_theme');
    }else{
        $theme = getAdminTheme();
    }
@endphp

<style>
    :root {
        --primary-color: {{ $theme->primary_color }} !important;
        --hover-color: {{ $theme->hover_color }} !important;
        --secondary-color: {{ $theme->secondary_color }} !important;
        --success-color: {{ $theme->success_color }} !important;
        --info-color: {{ $theme->info_color }} !important;
        --warning-color: {{ $theme->warning_color }} !important;
        --danger-color: {{ $theme->danger_color }} !important;
    }
</style>
