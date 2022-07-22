@extends('website.layout.app')

@section('content')
    <!-- ====== Banner Start ====== -->
    <section class="ud-page-banner">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="ud-banner-content">
                        <h1>{{ $plan->name }} - {{ __('Plan') }}</h1>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ====== Banner End ====== -->

    <!-- ====== About Start ====== -->
    <section id="about" class="ud-about">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://logowik.com/content/uploads/images/897_paypal.jpg" alt="">
                        </div>
                        <div class="card-body">
                            <button id="paypal_btn" type="button" class="ud-main-btn ud-white-btn">Pay via Paypal</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/stripe-2022-03-27-03-00-08-1300.png"
                                alt="">
                        </div>
                        <div class="card-body">
                            <button id="stripe_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Stripe</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/razorpay-2022-05-11-08-35-46-3554.png"
                                alt="">
                        </div>
                        <div class="card-body">
                            <button id="razorpay_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Razorpay</button>

                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://i.pinimg.com/originals/52/47/5c/52475c55421dbc2cd5e0312032b54495.png"
                                alt="">
                        </div>
                        <div class="card-body border-0">
                            <button id="flutter_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Flutterwave</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/mollie-2022-05-11-08-37-29-7747.png"
                                alt="">
                        </div>
                        <div class="card-body">
                            <button id="mollie_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Mollie</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/paystack-2022-05-11-08-37-01-5856.png"
                                alt="">
                        </div>
                        <div class="card-body">
                            <button id="paystack_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Paystack</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/instamojo-2022-05-11-08-38-16-6902.png"
                                alt="">
                        </div>
                        <div class="card-body">
                            <button id="instamojo_btn" type="button" class="ud-main-btn ud-white-btn">Pay
                                via Instamojo</button>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image" src="https://mizuno.id/images/veritrans.png"
                                alt="">

                        </div>
                        <div class="card-body">
                            <a href="https://demo.websolutionus.com/docpoint/doctor/pay-with-instamojo/basic"
                                class="ud-main-btn ud-white-btn">Pay via Midtrans</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://avatars.githubusercontent.com/u/19384040?s=280&v=4" alt="">
                        </div>
                        <div class="card-body">
                            <a href="https://demo.websolutionus.com/docpoint/doctor/pay-with-instamojo/basic"
                                class="ud-main-btn ud-white-btn">Pay via SSlcommerz</a>
                        </div>
                    </div>
                </div>
                <div class="col-12 col-md-4 col-lg-3 p-3">
                    <div class="card text-center">
                        <div class="card-header">
                            <img class="card-img payment-card-image"
                                src="https://demo.websolutionus.com/docpoint/uploads/website-images/bank-2022-05-11-08-43-31-1711.jpg"
                                alt="">
                        </div>
                        <div class="card-body">
                            <a href="javascript:;" data-toggle="modal" data-target="#bankPayment"
                                class="ud-main-btn ud-white-btn">Pay via Bank</a>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="row">
                <div class="col-4">
                    <div class="card">
                        <div class="card-header">
                            <h4 class="card-title">Paypal</h4>
                        </div>
                        <div class="card-body">
                            <button class="ud-main-btn ud-white-btn btn-block">Pay Now</button>
                        </div>
                    </div>
                </div>
            </div> --}}
        </div>
    </section>

    {{-- Paypal Form --}}
    <form action="{{ route('paypal.post') }}" method="POST" class="d-none" id="paypal-form">
        @csrf

    </form>

    {{-- Stripe Form --}}
    <form action="{{ route('stripe.post') }}" method="POST" class="d-none">
        @csrf


        <script id="stripe_script" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
            data-key="{{ config('kodebazar.stripe_key') }}" data-amount="{{ session('stripe_amount') }}"
            data-name="{{ config('app.name') }}" data-description="Money pay with stripe"
            data-locale="{{ app()->getLocale() == 'en' ? 'en' : app()->getLocale() }}" data-currency="USD"></script>
    </form>

    {{-- Razorpay Form --}}
    <form action="{{ route('razorpay.post') }}" method="POST" class="d-none">
        @csrf
        <script id="razor_script" src="https://checkout.razorpay.com/v1/checkout.js"
            data-key="{{ config('kodebazar.razorpay_key') }}" data-amount="{{ session('razor_amount') }}"
            data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}" data-description="Money pay with razorpay"
            data-prefill.name="{{ auth()->user()->name }}" data-prefill.email="{{ auth()->user()->email }}"
            data-theme.color="#2980b9" data-currency="INR"></script>
    </form>

    {{-- paystack_btn Form --}}
    <form action="{{ route('paystack.post') }}" method="POST" class="d-none" id="paystack-form">
        @csrf
    </form>

    {{-- flutterwave Form --}}
    <form action="{{ route('flutterwave.pay') }}" method="POST" class="d-none" id="flutter-form">
        @csrf
    </form>

    {{-- mollie Form --}}
    <form action="{{ route('mollie.payment') }}" method="POST" class="d-none" id="mollie-form">
        @csrf
    </form>

    {{-- instamojo Form --}}
    <form action="{{ route('instamojo.pay') }}" method="POST" class="d-none" id="instamojo-form">
        @csrf
    </form>

    {{-- SSL Form --}}
    <form method="POST" class="needs-validation d-none" novalidate>
        <input type="hidden" value="{{ $plan->price }}" name="amount" id="total_amount" />
        <input id="ssl_plan_id" type="hidden" name="plan_id" value="{{ $plan->id }}">
        <button class="btn btn-primary" id="sslczPayBtn" token="if you have any token validation"
            postdata="your javascript arrays or objects which requires in backend"
            order="If you already have the transaction generated for current order" endpoint="{{ route('ssl.pay') }}">
            {{ __('pay_now') }}
        </button>
    </form>
@endsection

@section('custom-scripts')
    <script>
        // Paypal
        $('#paypal_btn').on('click', function(e) {
            e.preventDefault();
            $('#paypal-form').submit();
        });

        // Stripe
        $('#stripe_btn').on('click', function(e) {
            e.preventDefault();
            $('.stripe-button-el').click();
        });

        // Razorpay
        $('#razorpay_btn').on('click', function(e) {
            e.preventDefault();
            $('.razorpay-payment-button').click();
        });

        // Paystack
        $('#paystack_btn').on('click', function(e) {
            e.preventDefault();
            $('#paystack-form').submit();
        });

        // Flutterwave
        $('#flutter_btn').on('click', function(e) {
            e.preventDefault();
            $('#flutter-form').submit();
        });

        // Mollie
        $('#mollie_btn').on('click', function(e) {
            e.preventDefault();
            $('#mollie-form').submit();
        });

        // Instamojo
        $('#instamojo_btn').on('click', function(e) {
            e.preventDefault();
            $('#instamojo-form').submit();
        });

        // Instamojo
        $('#ssl_btn').on('click', function(e) {
            e.preventDefault();
            $('#sslczPayBtn').click();
        });

        // ssl commerz
        var obj = {};
        obj.amount = $('#total_amount').val();
        obj.plan_id = $('#ssl_plan_id').val();

        $('#sslczPayBtn').prop('postdata', obj);

        (function(window, document) {
            var loader = function() {
                var script = document.createElement("script"),
                    tag = document.getElementsByTagName("script")[0];
                if ('{{ config('kodebazar.ssl_mode') }}' == 'sandbox') {
                    script.src = "https://sandbox.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(
                            7); // USE THIS FOR SANDBOX
                } else {
                    script.src = "https://seamless-epay.sslcommerz.com/embed.min.js?" + Math.random().toString(36)
                        .substring(7); // USE THIS FOR LIVE
                }
                tag.parentNode.insertBefore(script, tag);
            };

            window.addEventListener ? window.addEventListener("load", loader, false) : window.attachEvent("onload",
                loader);
        })(window, document);
    </script>
@endsection

@section('custom-links')
    <style>
        .payment-card-image {
            height: 100px !important;
            width: 100% !important;
            object-fit: cover !important;
        }

        .card .card-body {
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
@endsection
