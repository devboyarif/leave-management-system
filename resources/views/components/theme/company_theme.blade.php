@php
$user = auth()->user();

if ($user->role == 'company') {
    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->company->theme]);
    }

    $company_theme = session('company_theme');
} else {
    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->employee->company->theme]);
    }

    $company_theme = session('company_theme');
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
