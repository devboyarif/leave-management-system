<header class="ud-header">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <nav class="navbar navbar-expand-lg">
                    <a class="navbar-brand" href="index.html">
                        <img src="{{ $setting->app_light_logo }}" alt="Logo" />
                    </a>
                    <button class="navbar-toggler">
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                        <span class="toggler-icon"> </span>
                    </button>

                    <div class="navbar-collapse">
                        <ul id="nav" class="navbar-nav mx-auto">
                            <li class="nav-item">
                                <a class="ud-menu-scroll {{ request()->routeIs('website.home') ? 'active' : '' }}"
                                    href="{{ route('website.home') }}">{{ __('Home') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll {{ request()->routeIs('website.about') ? 'active' : '' }}"
                                    href="{{ route('website.about') }}">{{ __('About') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll {{ request()->routeIs('website.pricing') ? 'active' : '' }}"
                                    href="{{ route('website.pricing') }}">{{ __('Pricing') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll {{ request()->routeIs('website.blog') ? 'active' : '' }}"
                                    href="{{ route('website.blog') }}">{{ __('Blog') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="ud-menu-scroll {{ request()->routeIs('website.contact') ? 'active' : '' }}"
                                    href="{{ route('website.contact') }}">{{ __('Contact') }}</a>
                            </li>
                        </ul>
                    </div>

                    <div class="navbar-btn d-none d-sm-inline-block">
                        @if (auth()->check())
                            <a class="ud-main-btn ud-white-btn" href="{{ route('dashboard') }}">
                                {{ __('Dashboard') }}
                            </a>
                        @else
                            <a href="{{ route('login') }}" class="ud-main-btn ud-login-btn">
                                {{ __('Sign In') }}
                            </a>
                            <a class="ud-main-btn ud-white-btn" href="{{ route('register') }}">
                                {{ __('Sign Up') }}
                            </a>
                        @endif

                    </div>
                </nav>
            </div>
        </div>
    </div>
</header>
