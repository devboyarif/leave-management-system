@php
$website_theme = getAdminTheme();
@endphp

@if ($website_theme)
    <style>
        :root {
            --primary-color: {{ $website_theme->website_primary_color }} !important;
            --secondary-color: {{ $website_theme->website_secondary_color }} !important;
            --heading-text-color: {{ $website_theme->website_heading_text_color }} !important;
            --body-text-color: {{ $website_theme->website_body_text_color }} !important;
        }
    </style>
@endif
