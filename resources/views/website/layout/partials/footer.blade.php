<footer class="ud-footer wow fadeInUp" data-wow-delay=".15s">
    <div class="shape shape-1">
        <img src="{{ asset('website') }}/images/footer/shape-1.svg" alt="shape" />
    </div>
    <div class="shape shape-2">
        <img src="{{ asset('website') }}/images/footer/shape-2.svg" alt="shape" />
    </div>
    <div class="shape shape-3">
        <img src="{{ asset('website') }}/images/footer/shape-3.svg" alt="shape" />
    </div>
    <div class="ud-footer-widgets">
        <div class="container">
            <div class="row">
                <div class="col-xl-4 col-lg-4 col-md-6">
                    <div class="ud-widget">
                        <a href="{{ route('website.home') }}" class="ud-footer-logo">
                            <img src="{{ $setting->app_light_logo }}" alt="Logo" />
                        </a>
                        <p class="ud-widget-desc">
                            {{ $cms->home_banner_description }}
                        </p>
                        <ul class="ud-widget-socials">
                            @if ($setting->facebook)
                                <li>
                                    <a href="{{ $setting->facebook }}">
                                        <i class="lni lni-facebook-filled"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($setting->twitter)
                                <li>
                                    <a href="{{ $setting->twitter }}">
                                        <i class="lni lni-twitter-filled"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($setting->linkedin)
                                <li>
                                    <a href="{{ $setting->linkedin }}">
                                        <i class="lni lni-linkedin-original"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($setting->youtube)
                                <li>
                                    <a href="{{ $setting->youtube }}">
                                        <i class="lni lni-youtube"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($setting->instagram)
                                <li>
                                    <a href="{{ $setting->instagram }}">
                                        <i class="lni lni-instagram-filled"></i>
                                    </a>
                                </li>
                            @endif
                            @if ($setting->pinterest)
                                <li>
                                    <a href="{{ $setting->pinterest }}">
                                        <i class="lni lni-pinterest"></i>
                                    </a>
                                </li>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="col-xl-2 col-lg-2 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ __('About Us') }}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ route('website.home') }}">{{ __('Home') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.about') }}">{{ __('About') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.home', ['#testimonials']) }}">{{ __('Testimonial') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.contact') }}">{{ __('Contact') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ __('Our Support') }}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ route('website.privacy.policy') }}">{{ __('Privacy Policy') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('website.terms.condition') }}">{{ __('Terms & Condition') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">{{ __('Quick Links') }}</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="{{ route('website.pricing') }}" rel="nofollow noopner">{{ __('Pricing') }}
                                </a>
                            </li>
                            <li>
                                <a href="{{ route('website.blog') }}" rel="nofollow noopner">{{ __('Blog') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('login') }}" rel="nofollow noopner">{{ __('Login') }}</a>
                            </li>
                            <li>
                                <a href="{{ route('register') }}" rel="nofollow noopner">{{ __('Register') }}</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="ud-footer-bottom">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 text-center">
                    <p class="text-light">
                        {{ $setting->app_copyright }}
                    </p>
                </div>
            </div>
        </div>
    </div>
</footer>
