<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
    <link rel="stylesheet" href="{{ asset('admin') }}/css/adminlte.css" />
    <link rel="stylesheet" href="{{ asset('kodebazar') }}/font-awesome/v6/css/all.min.css" />
    <link href="{{ mix('admin/css/app.css') }}" rel="stylesheet" />
    @include('components.theme.app_theme')
    @routes
    <script src="{{ mix('admin/js/compiled/app.js') }}" defer></script>
</head>

<body>
    @inertia
</body>

</html>
