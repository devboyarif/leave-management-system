@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ __('Contact Page') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== Contact Start ====== -->
    <section id="contact" class="ud-contact">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-8 col-lg-7">
                    <div class="ud-contact-content-wrapper">
                        <div class="ud-contact-title">
                            <span>{{ __('Contact Us') }}</span>
                            <h2>
                                {{ __('Lets talk about') }} <br />
                                {{ __('Love to hear from you') }}
                            </h2>
                        </div>
                        <div class="ud-contact-info-wrapper">
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-map-marker"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>{{ __('Our Location') }}</h5>
                                    <p>{{ $setting->app_location }}</p>
                                </div>
                            </div>
                            <div class="ud-single-info">
                                <div class="ud-info-icon">
                                    <i class="lni lni-envelope"></i>
                                </div>
                                <div class="ud-info-meta">
                                    <h5>{{ __('How Can We Help') }}</h5>
                                    <p>{{ $setting->app_email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5">
                    <div class="ud-contact-form-wrapper wow fadeInUp" data-wow-delay=".2s">
                        <h3 class="ud-contact-form-title">{{ __('Send us a Message') }}</h3>
                        <form class="ud-contact-form">
                            <div class="ud-form-group">
                                <label for="fullName">{{ __('Full Name') }}*</label>
                                <input type="text" name="fullName" placeholder="{{ __('Full Name') }}" />
                            </div>
                            <div class="ud-form-group">
                                <label for="email">{{ __('Email') }}*</label>
                                <input type="email" name="email" placeholder="{{ __('Email') }}" />
                            </div>
                            <div class="ud-form-group">
                                <label for="phone">{{ __('Phone') }}*</label>
                                <input type="text" name="phone" placeholder="+123456789" />
                            </div>
                            <div class="ud-form-group">
                                <label for="message">{{ __('Message') }}*</label>
                                <textarea name="message" rows="5" placeholder="{{ __('Message') }}"></textarea>
                            </div>
                            <div class="ud-form-group mb-0">
                                <button type="submit" class="ud-main-btn">
                                    {{ __('Send Message') }}
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
