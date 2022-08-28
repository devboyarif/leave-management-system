@if (auth()->check() && (auth()->user()->role == 'owner' || auth()->user()->role == 'employee'))
    <x-theme.company_theme />
@else
    <x-theme.admin_theme />
@endif
