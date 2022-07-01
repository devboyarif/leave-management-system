@php
if (!session()->has('theme')) {
    session(['theme' => auth()->user()->theme]);
}

$theme = session('theme');

@endphp

<style>
    .btn-primary {
        background-color: {{ $theme->primary_color }} !important;
        border-color: {{ $theme->primary_color }} !important;
    }

    .btn-secondary {
        background-color: {{ $theme->secondary_color }} !important;
        border-color: {{ $theme->secondary_color }} !important;
    }

    .btn-success {
        background-color: {{ $theme->success_color }} !important;
        border-color: {{ $theme->success_color }} !important;
    }

    .btn-danger {
        background-color: {{ $theme->danger_color }} !important;
        border-color: {{ $theme->danger_color }} !important;
    }

    .btn-info {
        background-color: {{ $theme->info_color }} !important;
        border-color: {{ $theme->info_color }} !important;
    }

    .btn-warning {
        background-color: {{ $theme->warning_color }} !important;
        border-color: {{ $theme->warning_color }} !important;
    }

    .text-primary {
        color: {{ $theme->primary_color }} !important;
    }

    /* Pagination Color  */
    .page-item.active .page-link {
        background-color: {{ $theme->primary_color }} !important;
        border-color: {{ $theme->primary_color }} !important;
    }

    /* Sidebar Color  */
    .sidebar-dark-primary .nav-sidebar>.nav-item>.nav-link.active,
    .sidebar-light-primary .nav-sidebar>.nav-item>.nav-link.active {
        background-color: {{ $theme->primary_color }} !important;
        border-color: {{ $theme->primary_color }} !important;
    }


    /* Badge Color  */
    .badge-primary {
        background-color: {{ $theme->primary_color }} !important;
        color: #fff !important;
    }

    .badge-secondary {
        background-color: {{ $theme->secondary_color }} !important;
        color: #fff !important;
    }

    .badge-success {
        background-color: {{ $theme->success_color }} !important;
        color: #fff !important;
    }

    .badge-danger {
        background-color: {{ $theme->danger_color }} !important;
        color: #fff !important;
    }

    .badge-info {
        background-color: {{ $theme->info_color }} !important;
        color: #fff !important;
    }

    .badge-warning {
        background-color: {{ $theme->warning_color }} !important;
        color: #fff !important;
    }
</style>
