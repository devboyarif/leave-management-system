@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ __('About Page') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
        <div class="container">
            <div class="ud-about-wrapper wow fadeInUp" data-wow-delay=".2s">
                <div class="ud-about-content-wrapper">
                    <div class="ud-about-content">
                        <span class="tag">{{ $cms->about_title }}</span>
                        <h2>{{ $cms->about_subtitle }}</h2>
                        <p>
                            {!! $cms->about_description !!}
                        </p>
                    </div>
                </div>
                <div class="ud-about-image">
                    <img src="{{ $cms->about_image }}" alt="about-image" />
                </div>
            </div>
        </div>
    </section>
    <!-- ====== About End ====== -->

    <!-- ====== Testimonials Start ====== -->
    <x-website.testimonial-section :testimonials="$testimonials" />
    <!-- ====== Testimonials End ====== -->
@endsection
