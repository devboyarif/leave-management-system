@php
$user = auth()->user();

if ($user->role == 'owner') {
    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->companies->theme]);
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
        --primary-color: {{ $company_theme->primary_color }} !important;
        --hover-color: {{ $company_theme->hover_color }} !important;
        --secondary-color: {{ $company_theme->secondary_color }} !important;
        --success-color: {{ $company_theme->success_color }} !important;
        --info-color: {{ $company_theme->info_color }} !important;
        --warning-color: {{ $company_theme->warning_color }} !important;
        --danger-color: {{ $company_theme->danger_color }} !important;
    }
</style>
