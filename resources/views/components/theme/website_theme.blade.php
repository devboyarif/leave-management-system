@php
$theme = getAdminTheme();
@endphp

@if ($theme)
    <style>
        :root {
            --primary-color: {{ $theme->website_primary_color }} !important;
            --secondary-color: {{ $theme->website_secondary_color }} !important;
            --heading-text-color: {{ $theme->website_heading_text_color }} !important;
            --body-text-color: {{ $theme->website_body_text_color }} !important;
        }
    </style>
@endif
