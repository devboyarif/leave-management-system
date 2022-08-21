@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ __('Terms & Condition') }}</h1>
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
                {!! $cms->terms_description !!}
            </div>
        </div>
    </section>
    <!-- ====== Contact End ====== -->
@endsection
