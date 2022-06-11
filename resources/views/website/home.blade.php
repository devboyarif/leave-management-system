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
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style-one">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Basic</h5>
                            <span class="price">$199</span>
                            <h5 class="year">Per year</h5>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Carefully crafted
                                    components
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Amazing page
                                    examples
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Super friendly
                                    support team
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Awesome Support
                                </li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="btn primary-btn rounded-full" href="javascript:void(0)">
                                GET STARTED
                            </a>
                        </div>
                        <div class="bottom-shape">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 112.35">
                                <defs>
                                    <style>
                                        .color-1 {
                                            fill: #2bdbdc;
                                            isolation: isolate;
                                        }

                                        .cls-1 {
                                            opacity: 0.1;
                                        }

                                        .cls-2 {
                                            opacity: 0.2;
                                        }

                                        .cls-3 {
                                            opacity: 0.4;
                                        }

                                        .cls-4 {
                                            opacity: 0.6;
                                        }
                                    </style>
                                </defs>
                                <title>bottom-part1</title>
                                <g>
                                    <g data-name="Group 747">
                                        <path data-name="Path 294" class="cls-1 color-1"
                                            d="M0,24.21c120-55.74,214.32,2.57,267,0S349.18,7.4,349.18,7.4V82.35H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 297" class="cls-2 color-1"
                                            d="M350,34.21c-120-55.74-214.32,2.57-267,0S.82,17.4.82,17.4V92.35H350Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 296" class="cls-3 color-1"
                                            d="M0,44.21c120-55.74,214.32,2.57,267,0S349.18,27.4,349.18,27.4v74.95H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 295" class="cls-4 color-1"
                                            d="M349.17,54.21c-120-55.74-214.32,2.57-267,0S0,37.4,0,37.4v74.95H349.17Z"
                                            transform="translate(0 0)" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <!-- single pricing -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style-one">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Pro</h5>
                            <span class="price">$399</span>
                            <h5 class="year">Per year</h5>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Carefully crafted
                                    components
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Amazing page
                                    examples
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Super friendly
                                    support team
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Awesome Support
                                </li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="btn primary-btn rounded-full" href="javascript:void(0)">
                                GET STARTED
                            </a>
                        </div>
                        <div class="bottom-shape">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 112.35">
                                <defs>
                                    <style>
                                        .color-1 {
                                            fill: #2bdbdc;
                                            isolation: isolate;
                                        }

                                        .cls-1 {
                                            opacity: 0.1;
                                        }

                                        .cls-2 {
                                            opacity: 0.2;
                                        }

                                        .cls-3 {
                                            opacity: 0.4;
                                        }

                                        .cls-4 {
                                            opacity: 0.6;
                                        }
                                    </style>
                                </defs>
                                <title>bottom-part1</title>
                                <g>
                                    <g data-name="Group 747">
                                        <path data-name="Path 294" class="cls-1 color-1"
                                            d="M0,24.21c120-55.74,214.32,2.57,267,0S349.18,7.4,349.18,7.4V82.35H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 297" class="cls-2 color-1"
                                            d="M350,34.21c-120-55.74-214.32,2.57-267,0S.82,17.4.82,17.4V92.35H350Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 296" class="cls-3 color-1"
                                            d="M0,44.21c120-55.74,214.32,2.57,267,0S349.18,27.4,349.18,27.4v74.95H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 295" class="cls-4 color-1"
                                            d="M349.17,54.21c-120-55.74-214.32,2.57-267,0S0,37.4,0,37.4v74.95H349.17Z"
                                            transform="translate(0 0)" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <!-- single pricing -->
                </div>
                <div class="col-lg-4 col-md-7 col-sm-9">
                    <div class="pricing-style-one">
                        <div class="pricing-header text-center">
                            <h5 class="sub-title">Enterprise</h5>
                            <span class="price">$699</span>
                            <h5 class="year">Per year</h5>
                        </div>
                        <div class="pricing-list">
                            <ul>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Carefully crafted
                                    components
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Amazing page
                                    examples
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Super friendly
                                    support team
                                </li>
                                <li>
                                    <i class="lni lni-checkmark-circle"></i> Awesome Support
                                </li>
                            </ul>
                        </div>
                        <div class="pricing-btn rounded-buttons text-center">
                            <a class="btn primary-btn rounded-full" href="javascript:void(0)">
                                GET STARTED
                            </a>
                        </div>
                        <div class="bottom-shape">
                            <svg data-name="Layer 1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 350 112.35">
                                <defs>
                                    <style>
                                        .color-1 {
                                            fill: #2bdbdc;
                                            isolation: isolate;
                                        }

                                        .cls-1 {
                                            opacity: 0.1;
                                        }

                                        .cls-2 {
                                            opacity: 0.2;
                                        }

                                        .cls-3 {
                                            opacity: 0.4;
                                        }

                                        .cls-4 {
                                            opacity: 0.6;
                                        }
                                    </style>
                                </defs>
                                <title>bottom-part1</title>
                                <g>
                                    <g data-name="Group 747">
                                        <path data-name="Path 294" class="cls-1 color-1"
                                            d="M0,24.21c120-55.74,214.32,2.57,267,0S349.18,7.4,349.18,7.4V82.35H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 297" class="cls-2 color-1"
                                            d="M350,34.21c-120-55.74-214.32,2.57-267,0S.82,17.4.82,17.4V92.35H350Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 296" class="cls-3 color-1"
                                            d="M0,44.21c120-55.74,214.32,2.57,267,0S349.18,27.4,349.18,27.4v74.95H0Z"
                                            transform="translate(0 0)" />
                                        <path data-name="Path 295" class="cls-4 color-1"
                                            d="M349.17,54.21c-120-55.74-214.32,2.57-267,0S0,37.4,0,37.4v74.95H349.17Z"
                                            transform="translate(0 0)" />
                                    </g>
                                </g>
                            </svg>
                        </div>
                    </div>
                    <!-- single pricing -->
                </div>
            </div>
            <!-- row -->
        </div>
        <!-- container -->
    </section>
    <!--====== PRICING STYLE ONE ENDS ======-->
    <section id="pricing" class="ud-pricing">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-section-title mx-auto text-center">
                        <span>Pricing</span>
                        <h2>Our Pricing Plans</h2>
                        <p>
                            There are many variations of passages of Lorem Ipsum available
                            but the majority have suffered alteration in some form.
                        </p>
                    </div>
                </div>
            </div>

            <div class="row g-0 align-items-center justify-content-center">
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="ud-single-pricing first-item wow fadeInUp" data-wow-delay=".15s">
                        <div class="ud-pricing-header">
                            <h3>STARTING FROM</h3>
                            <h4>$ 19.99/mo</h4>
                        </div>
                        <div class="ud-pricing-body">
                            <ul>
                                <li>5 User</li>
                                <li>All UI components</li>
                                <li>Lifetime access</li>
                                <li>Free updates</li>
                                <li>Use on 1 (one) project</li>
                                <li>4 Months support</li>
                            </ul>
                        </div>
                        <div class="ud-pricing-footer">
                            <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                                Purchase Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="ud-single-pricing active wow fadeInUp" data-wow-delay=".1s">
                        <span class="ud-popular-tag">POPULAR</span>
                        <div class="ud-pricing-header">
                            <h3>STARTING FROM</h3>
                            <h4>$ 30.99/mo</h4>
                        </div>
                        <div class="ud-pricing-body">
                            <ul>
                                <li>5 User</li>
                                <li>All UI components</li>
                                <li>Lifetime access</li>
                                <li>Free updates</li>
                                <li>Use on 1 (one) project</li>
                                <li>4 Months support</li>
                            </ul>
                        </div>
                        <div class="ud-pricing-footer">
                            <a href="javascript:void(0)" class="ud-main-btn ud-white-btn">
                                Purchase Now
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6 col-sm-10">
                    <div class="ud-single-pricing last-item wow fadeInUp" data-wow-delay=".15s">
                        <div class="ud-pricing-header">
                            <h3>STARTING FROM</h3>
                            <h4>$ 70.99/mo</h4>
                        </div>
                        <div class="ud-pricing-body">
                            <ul>
                                <li>5 User</li>
                                <li>All UI components</li>
                                <li>Lifetime access</li>
                                <li>Free updates</li>
                                <li>Use on 1 (one) project</li>
                                <li>4 Months support</li>
                            </ul>
                        </div>
                        <div class="ud-pricing-footer">
                            <a href="javascript:void(0)" class="ud-main-btn ud-border-btn">
                                Purchase Now
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
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
    <style>
        /* ===== Buttons Css ===== */
        .pricing-style-one .primary-btn {
            background: var(--primary);
            color: var(--white);
            box-shadow: var(--shadow-2);
        }

        .pricing-style-one .active.primary-btn,
        .pricing-style-one .primary-btn:hover,
        .pricing-style-one .primary-btn:focus {
            background: var(--primary-dark);
            color: var(--white);
            box-shadow: var(--shadow-4);
        }

        .pricing-style-one .deactive.primary-btn {
            background: var(--gray-4);
            color: var(--dark-3);
            pointer-events: none;
        }

        /*===== PRICING STYLE ONE =====*/
        .pricing-one {
            padding: 100px 0;
        }

        .pricing-style-one {
            box-shadow: var(--shadow-4);
            padding: 45px 30px;
            border-radius: 8px;
            position: relative;
            z-index: 1;
            overflow: hidden;
            background-color: var(--white);
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
            color: var(--black);
            position: relative;
            padding: 6px 20px;
            display: inline-block;
            border: 2px solid var(--primary);
            border-radius: 30px;
        }

        .pricing-style-one .price {
            display: block;
            font-size: 55px;
            font-weight: 600;
            line-height: 80px;
            margin-top: 25px;
            color: var(--black);
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
            color: var(--dark-3);
            margin-top: 3px;
        }

        .pricing-style-one .pricing-list {
            margin-top: 40px;
        }

        .pricing-style-one .pricing-list li {
            color: var(--dark-3);
            margin-top: 16px;
        }

        .pricing-style-one .pricing-list li i {
            color: var(--primary);
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
