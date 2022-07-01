@php
$user = auth()->user();

if ($user->role == 'company') {
    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->employee->company->theme]);
    }

    $company_theme = session('company_theme');
} else {
    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->company->theme]);
    }

    $company_theme = session('company_theme');
}
@endphp

<style>
    /* Button Color  */
    .btn-primary {
        background-color: {{ $company_theme->primary_color }} !important;
        border-color: {{ $company_theme->primary_color }} !important;
    }

    .btn-secondary {
        background-color: {{ $company_theme->secondary_color }} !important;
        border-color: {{ $company_theme->secondary_color }} !important;
    }

    .btn-success {
        background-color: {{ $company_theme->success_color }} !important;
        border-color: {{ $company_theme->success_color }} !important;
    }

    .btn-danger {
        background-color: {{ $company_theme->danger_color }} !important;
        border-color: {{ $company_theme->danger_color }} !important;
    }

    .btn-info {
        background-color: {{ $company_theme->info_color }} !important;
        border-color: {{ $company_theme->info_color }} !important;
    }

    .btn-warning {
        background-color: {{ $company_theme->warning_color }} !important;
        border-color: {{ $company_theme->warning_color }} !important;
    }

    .text-primary {
        color: {{ $company_theme->primary_color }} !important;
    }

    /* Button Color  */
    .info-box-icon.bg-primary {
        background-color: {{ $company_theme->primary_color }} !important;
    }

    .info-box-icon.bg-secondary {
        background-color: {{ $company_theme->secondary_color }} !important;
    }

    .info-box-icon.bg-success {
        background-color: {{ $company_theme->success_color }} !important;
    }

    .info-box-icon.bg-danger {
        background-color: {{ $company_theme->danger_color }} !important;
    }

    .info-box-icon.bg-info {
        background-color: {{ $company_theme->info_color }} !important;
    }

    .info-box-icon.bg-warning {
        background-color: {{ $company_theme->warning_color }} !important;
    }

    .text-primary {
        color: {{ $company_theme->primary_color }} !important;
    }


    /* Pagination Color  */
    .page-item.active .page-link {
        background-color: {{ $company_theme->primary_color }} !important;
        border-color: {{ $company_theme->primary_color }} !important;
    }

    /* Sidebar Color  */
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: {{ $company_theme->primary_color }} !important;
        border-color: {{ $company_theme->primary_color }} !important;
    }


    /* Badge Color  */
    .badge-primary {
        background-color: {{ $company_theme->primary_color }} !important;
        color: #fff !important;
    }

    .badge-secondary {
        background-color: {{ $company_theme->secondary_color }} !important;
        color: #fff !important;
    }

    .badge-success {
        background-color: {{ $company_theme->success_color }} !important;
        color: #fff !important;
    }

    .badge-danger {
        background-color: {{ $company_theme->danger_color }} !important;
        color: #fff !important;
    }

    .badge-info {
        background-color: {{ $company_theme->info_color }} !important;
        color: #fff !important;
    }

    .badge-warning {
        background-color: {{ $company_theme->warning_color }} !important;
        color: #fff !important;
    }
</style>
