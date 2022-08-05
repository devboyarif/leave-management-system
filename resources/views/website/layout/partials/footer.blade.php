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
                        <a href="index.html" class="ud-footer-logo">
                            <img src="{{ $setting->app_light_logo }}" alt="Logo" />
                        </a>
                        <p class="ud-widget-desc">
                            We create digital experiences for brands and companies by
                            using technology.
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
                        <h5 class="ud-widget-title">About Us</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="javascript:void(0)">Home</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">About</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Testimonial</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">Our Support</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="javascript:void(0)">Privacy policy</a>
                            </li>
                            <li>
                                <a href="javascript:void(0)">Terms & Condition</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-3 col-md-6 col-sm-6">
                    <div class="ud-widget">
                        <h5 class="ud-widget-title">Quick Links</h5>
                        <ul class="ud-widget-links">
                            <li>
                                <a href="https://lineicons.com/" rel="nofollow noopner" target="_blank">Pricing
                                </a>
                            </li>
                            <li>
                                <a href="https://ecommercehtml.com/" rel="nofollow noopner" target="_blank">Blog</a>
                            </li>
                            <li>
                                <a href="https://ecommercehtml.com/" rel="nofollow noopner" target="_blank">Login</a>
                            </li>
                            <li>
                                <a href="https://ecommercehtml.com/" rel="nofollow noopner" target="_blank">Register</a>
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
                    {{-- <ul class="ud-footer-bottom-left">
                        <li>
                            <a href="javascript:void(0)">Privacy policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Support policy</a>
                        </li>
                        <li>
                            <a href="javascript:void(0)">Terms of service</a>
                        </li>
                    </ul> --}}
                </div>
                {{-- <div class="col-md-4">
                    <p class="ud-footer-bottom-right">
                        Designed and Developed by
                        <a href="https://uideck.com" rel="nofollow">UIdeck</a>
                    </p>
                </div> --}}
            </div>
        </div>
    </div>
</footer>
