@extends('website.layout.app')

@section('content')
    <!-- ====== Hero Start ====== -->
    <section class="ud-hero" id="home">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-hero-content wow fadeInUp" data-wow-delay=".2s">
                        <h1 class="ud-hero-title">
                            Open-Source Web Template for SaaS, Startup, Apps, and More
                        </h1>
                        <p class="ud-hero-desc">
                            Multidisciplinary Web Template Built with Your Favourite
                            Technology - HTML Bootstrap, Tailwind and React NextJS.
                        </p>
                        <ul class="ud-hero-buttons">
                            <li>
                                <a href="https://links.uideck.com/play-bootstrap-download" rel="nofollow noopener"
                                    target="_blank" class="ud-main-btn ud-white-btn">
                                    Download Now
                                </a>
                            </li>
                            <li>
                                <a href="https://github.com/uideck/play-bootstrap" rel="nofollow noopener" target="_blank"
                                    class="ud-main-btn ud-link-btn">
                                    Learn More <i class="lni lni-arrow-right"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="ud-hero-brands-wrapper wow fadeInUp" data-wow-delay=".3s">
                        <img src="{{ asset('website') }}/images/hero/brand.svg" alt="brand" />
                    </div>
                    <div class="ud-hero-image wow fadeInUp" data-wow-delay=".25s">
                        <img src="{{ asset('website') }}/images/hero/hero-image.svg" alt="hero-image" />
                        <img src="{{ asset('website') }}/images/hero/dotted-shape.svg" alt="shape"
                            class="shape shape-1" />
                        <img src="{{ asset('website') }}/images/hero/dotted-shape.svg" alt="shape"
                            class="shape shape-2" />
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Hero End ====== -->

    <!-- ====== Features Start ====== -->
    @if ($features && count($features))
        <section id="features" class="ud-features">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="ud-section-title">
                            <span>Features</span>
                            <h2>Main Features of Play</h2>
                            <p>
                                There are many variations of passages of Lorem Ipsum available
                                but the majority have suffered alteration in some form.
                            </p>
                        </div>
                    </div>
                </div>
                <div class="row">
                    @foreach ($features as $feature)
                        <div class="col-xl-3 col-lg-3 col-sm-6">
                            <div class="ud-single-feature wow fadeInUp" data-wow-delay=".1s">
                                <div class="ud-feature-icon">
                                    <i class="{{ $feature->icon }}"></i>
                                </div>
                                <div class="ud-feature-content">
                                    <h3 class="ud-feature-title">{{ $feature->title }}</h3>
                                    <p class="ud-feature-desc">
                                        {{ $feature->description }}
                                    </p>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        </section>
    @endif
    <!-- ====== Features End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-content-wrapper">
                    <div class="ud-about-content">
                        <span class="tag">About Us</span>
                        <h2>Brilliant Toolkit to Build Nextgen Website Faster.</h2>
                        <p>
                            The main ‘thrust’ is to focus on educating attendees on how to
                            best protect highly vulnerable business applications with
                            interactive panel discussions and roundtables led by subject
                            matter experts.
                        </p>

                        <p>
                            The main ‘thrust’ is to focus on educating attendees on how to
                            best protect highly vulnerable business applications with
                            interactive panel.
                        </p>
                        <a href="javascript:void(0)" class="ud-main-btn">Learn More</a>
                    </div>
                </div>
                <div class="ud-about-image">
                    <img src="{{ asset('website') }}/images/about/about-image.svg" alt="about-image" />
                </div>
            </div>
        </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Pricing Start ====== -->
    <!--====== PRICING STYLE ONE START ======-->
    <section class="pricing-area pricing-one">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-xxl-6 col-xl-7 col-lg-8">
                    <div class="section-title text-center">
                        <h2 class="mb-3 fw-bold">Our Pricing</h2>
                        <p class="text-lg">
                            Morem ipsum dolor sit amet consectetur, adipisicing elit. Illum
                            quam suscipit distinctio optio, quaerat consequatur labore
                            pariatur rerum.
                        </p>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                @foreach ($plans as $plan)
                    <div class="col-lg-3 col-md-7 col-sm-9">
                        <div class="pricing-style-one">
                            <div class="pricing-header text-center">
                                <h5 class="sub-title">{{ $plan->name }}</h5>
                                <span class="price">${{ $plan->price }}</span>
                                @if ($plan->interval == 'custom_date')
                                    <small>/{{ $plan->custom_interval_days }} {{ __('Days') }}</small>
                                @else
                                    <small>/{{ $plan->interval }}</small>
                                @endif
                            </div>
                            <div class="pricing-list">

                                <ul>
                                    <li>
                                        <i
                                            class="lni {{ !$plan->planFeatures->is_limited_user ? 'lni-checkmark-circle text-success' : 'lni-cross-circle text-danger' }}"></i>
                                        Unlimited Employees

                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        Max Employees -
                                        <b>{{ $plan->planFeatures->is_limited_user ? $plan->planFeatures->max_employees : '∞' }}</b>
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        Max Teams - <b>{{ $plan->planFeatures->max_teams }}</b>
                                    </li>
                                    <li>
                                        <i class="lni lni-checkmark-circle text-success"></i>
                                        Max Leave Types - <b>{{ $plan->planFeatures->max_leave_types }}</b>
                                    </li>
                                    <li>
                                        <i
                                            class="lni {{ $plan->planFeatures->custom_theme_look ? 'lni-checkmark-circle text-success' : 'lni-cross-circle text-danger' }}"></i>
                                        Custom Theme Look
                                    </li>
                                </ul>
                            </div>
                            <div class="pricing-btn rounded-buttons text-center">
                                @if (auth()->check() && auth()->user()->role == 'company')
                                    <a class="btn primary-btn rounded-full price-btn"
                                        href="{{ $plan->id == session('current_subscription')->plan_id ? 'javascript:void(0)' : route('website.plan.details', $plan->slug) }}">
                                        @if ($plan->id == session('current_subscription')->plan_id)
                                            Current Plan
                                        @else
                                            Subscribe Now
                                        @endif
                                    </a>
                                @else
                                    <a class="btn primary-btn rounded-full price-btn {{ !auth()->check() ? 'login_required' : '' }} {{ auth()->check() && auth()->user()->role == 'admin' ? 'not_acceptable' : '' }}"
                                        href="javascript:void(0)">
                                        GET STARTED
                                    </a>
                                @endif

                                {{-- session('current_subscription') --}}
                            </div>
                        </div>
                        <!-- single pricing -->
                    </div>
                @endforeach
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!--====== PRICING STYLE ONE ENDS ======-->
    <!-- ====== Pricing End ====== -->

    <!-- ====== FAQ Start ====== -->
    <x-website.faq-section :faqs="$faqs" />
    <!-- ====== FAQ End ====== -->

    <!-- ====== Testimonials Start ====== -->
    <x-website.testimonial-section :testimonials="$testimonials" />
    <!-- ====== Testimonials End ====== -->

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="ud-contact-content-wrapper">
                        <div class="ud-contact-title">
                            <span>CONTACT US</span>
                            <h2>
                                Let’s talk about <br />
                                Love to hear from you!
                            </h2>
                        </div>
                        <div class="ud-contact-info-wrapper">
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-map-marker"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>Our Location</h5>
                                    <p>401 Broadway, 24th Floor, Orchard Cloud View, London</p>
                                </div>
                            </div>
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>How Can We Help?</h5>
                                    <p>info@yourdomain.com</p>
                                    <p>contact@yourdomain.com</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="ud-contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="ud-contact-form-title">Send us a Message</h3>
                        <form class="ud-contact-form">
                            <div class="ud-form-group">
                                <label for="fullName">Full Name*</label>
                                <input type="text" name="fullName" placeholder="Adam Gelius" />
                            </div>
                            <div class="ud-form-group">
                                <label for="email">Email*</label>
                                <input type="email" name="email" placeholder="example@yourmail.com" />
                            </div>
                            <div class="ud-form-group">
                                <label for="phone">Phone*</label>
                                <input type="text" name="phone" placeholder="+885 1254 5211 552" />
                            </div>
                            <div class="ud-form-group">
                                <label for="message">Message*</label>
                                <textarea name="message" rows="1" placeholder="type your message here"></textarea>
                            </div>
                            <div class="ud-form-group mb-0">
                                <button type="submit" class="ud-main-btn">
                                    Send Message
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Contact End ====== -->
@endsection

@section('custom-links')
    @php
    $theme = getAdminTheme();
    @endphp

    <style>
        .price-btn {
            font-weight: bold;
            font-size: 16px;
            line-height: 20px;
            text-align: center;
            letter-spacing: 0.08em;
            text-transform: uppercase;
            padding: 12px 24px;
            border-radius: 4px;
            border: 1px solid transparent;
        }

        .btn.rounded-full {
            border-radius: 50px;
        }

        .pricing-style-one .primary-btn {
            background: {{ $theme->website_primary_color }};
            color: #fff;
            box-shadow: 0px 0px 1px rgba(40, 41, 61, 0.04),
                0px 2px 4px rgba(96, 97, 112, 0.16);
        }

        .pricing-style-one .active.primary-btn,
        .pricing-style-one .primary-btn:hover,
        .pricing-style-one .primary-btn:focus {
            background: {{ $theme->website_primary_color }};
            color: #fff;
            box-shadow: 0px 2px 4px rgba(40, 41, 61, 0.04), ;
        }

        .pricing-style-one .deactive.primary-btn {
            background: #e0e0e0;
            color: #6d6d6d;
            pointer-events: none;
        }

        /*===== PRICING STYLE ONE =====*/
        .pricing-one {
            padding: 100px 0;
        }

        .pricing-style-one {
            box-shadow: 0px 8px 16px rgba(96, 97, 112, 0.16);
            padding: 45px 30px;
            border-radius: 8px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            background-color: #fff;
            margin-top: 50px;
        }

        @media only screen and (min-width: 768px) and (max-width: 991px),
        (max-width: 767px) {
            .pricing-style-one {
                padding: 35px 30px;
            }
        }

        .pricing-style-one .sub-title {
            font-size: 16px;
            color: #1d1d1d;
            position: relative;
            padding: 6px 20px;
            display: inline-block;
            border: 2px solid {{ $theme->website_primary_color }};
            border-radius: 30px;
        }

        .pricing-style-one .price {
            display: block;
            font-size: 55px;
            font-weight: 600;
            line-height: 80px;
            margin-top: 25px;
            color: #1d1d1d;
        }

        @media (max-width: 767px) {
            .pricing-style-one .price {
                font-size: 45px;
                margin-top: 16px;
            }
        }

        @media only screen and (min-width: 576px) and (max-width: 767px) {
            .pricing-style-one .price {
                font-size: 50px;
                margin-top: 20px;
            }
        }

        .pricing-style-one .year {
            color: #6d6d6d;
            margin-top: 3px;
        }

        .pricing-style-one .pricing-list {
            margin-top: 40px;
        }

        .pricing-style-one .pricing-list li {
            color: #6d6d6d;
            margin-top: 16px;
        }

        .pricing-style-one .pricing-list li i {
            color: {{ $theme->website_primary_color }};
            margin-right: 8px;
        }

        .pricing-style-one .pricing-btn {
            margin-top: 42px;
        }

        .pricing-style-one .bottom-shape {
            position: absolute;
            bottom: -20px;
            left: 0;
            width: 101%;
            z-index: -1;
        }
    </style>
@endsection
