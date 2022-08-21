<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <!-- ===== All Tags ===== -->
    @include('website.layout.partials.meta')

    <title>{{ __('Home') }} | {{ config('app.name') }}</title>

    <!--====== Favicon Icon ======-->
    <link rel="shortcut icon" href="{{ $setting->app_favicon }}" type="image/svg" />

    @routes


    <!-- ===== All CSS files ===== -->
    @include('website.layout.partials.links')
</head>

<body>
    <!-- ====== Header Start ====== -->
    @include('website.layout.partials.header')
    <!-- ====== Header End ====== -->

    @yield('content')

    <!-- ====== Footer Start ====== -->
    @include('website.layout.partials.footer')
    <!-- ====== Footer End ====== -->

    <!-- ====== Back To Top Start ====== -->
    <a href="javascript:void(0)" class="back-to-top">
        <i class="lni lni-chevron-up"> </i>
    </a>
    <!-- ====== Back To Top End ====== -->

    <!-- ====== All Javascript Files ====== -->
    @include('website.layout.partials.scripts')
</body>

</html>
