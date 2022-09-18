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
@php
    $paypal_mode = config('paypal.mode');
    $paypal_active = config('paypal.active');
    $paypal_client_id = config('paypal.'.$paypal_mode.'.client_id');
    $paypal_client_secret = config('paypal.'.$paypal_mode.'.client_secret');

    $stripe = config('kodebazar.stripe_key') && config('kodebazar.stripe_secret') && config('kodebazar.stripe_active');
    $razorpay = config('kodebazar.razorpay_key') && config('kodebazar.razorpay_secret') &&
    config('kodebazar.razorpay_active');
    $paystack = config('kodebazar.paystack_key') && config('kodebazar.paystack_secret') &&
    config('kodebazar.paystack_merchant') && config('kodebazar.paystack_active');
    $flutterwave = config('kodebazar.flw_public_key') && config('kodebazar.flw_secret') &&
    config('kodebazar.flw_secret_hash') && config('kodebazar.flw_active');
    $instamojo = config('kodebazar.im_key') && config('kodebazar.im_secret') && config('kodebazar.im_active');
    $midtrans = config('kodebazar.midtrans_id') && config('kodebazar.midtrans_key') && config('kodebazar.midtrans_secret')
    && config('kodebazar.midtrans_active');
    $mollie = config('kodebazar.mollie_key') && config('kodebazar.mollie_active');
@endphp

<section id="about" class="ud-about">
    <div class="container">
        <div class="row">
            @if ($paypal_active && $paypal_client_id && $paypal_client_secret)
            {{-- Paypal  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/paypal.jpg') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="paypal_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Paypal') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($stripe)
            {{-- Stripe  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/stripe.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="stripe_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Stripe') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($razorpay)
            {{-- Razorpay  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/razorpay.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="razorpay_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Razorpay') }}</button>

                    </div>
                </div>
            </div>
            @endif

            @if ($flutterwave)
            {{-- Flutterwave  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/flutterwave.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body border-0">
                        <button id="flutter_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Flutterwave') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($mollie)
            {{-- Mollie  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/mollie.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="mollie_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Mollie') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($paystack)
            {{-- Paystack  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/paystack.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="paystack_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Paystack') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($instamojo)
            {{-- Instamojo  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/instamojo.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="instamojo_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Instamojo') }}</button>
                    </div>
                </div>
            </div>
            @endif

            @if ($midtrans)
            {{-- Midtrans  --}}
            <div class="col-12 col-md-4 col-lg-3 p-3">
                <div class="card text-center">
                    <div class="card-header">
                        <img class="card-img payment-card-image" src="{{ asset('website/images/payment/midtrans.png') }}"
                            alt="image">
                    </div>
                    <div class="card-body">
                        <button id="midtrans_btn" type="button"
                            class="ud-main-btn ud-white-btn">{{ __('Pay via Midtrans') }}</button>
                    </div>
                </div>
            </div>
            @endif
        </div>
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
        data-buttontext="Pay with Razorpay" data-name="{{ config('app.name') }}"
        data-description="Money pay with razorpay" data-prefill.name="{{ auth()->user()->name }}"
        data-prefill.email="{{ auth()->user()->email }}" data-theme.color="#2980b9" data-currency="INR"></script>
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
@endsection

@section('custom-scripts')
@if (config('kodebazar.midtrans_active') &&
config('kodebazar.midtrans_id') &&
config('kodebazar.midtrans_key') &&
config('kodebazar.midtrans_secret'))
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ config('kodebazar.midtrans_key') }}">
</script>
@endif
<script>
    // Paypal
    $('#paypal_btn').on('click', function (e) {
        e.preventDefault();
        $('#paypal-form').submit();
    });

    // Stripe
    $('#stripe_btn').on('click', function (e) {
        e.preventDefault();
        $('.stripe-button-el').click();
    });

    // Razorpay
    $('#razorpay_btn').on('click', function (e) {
        e.preventDefault();
        $('.razorpay-payment-button').click();
    });

    // Paystack
    $('#paystack_btn').on('click', function (e) {
        e.preventDefault();
        $('#paystack-form').submit();
    });

    // Flutterwave
    $('#flutter_btn').on('click', function (e) {
        e.preventDefault();
        $('#flutter-form').submit();
    });

    // Mollie
    $('#mollie_btn').on('click', function (e) {
        e.preventDefault();
        $('#mollie-form').submit();
    });

    // Instamojo
    $('#instamojo_btn').on('click', function (e) {
        e.preventDefault();
        $('#instamojo-form').submit();
    });

    // ssl commerz
    $('#ssl_btn').on('click', function (e) {
        e.preventDefault();
        $('#sslczPayBtn').click();
    });

    // Midtrans
    if (
        '{{ config('
        kodebazar.midtrans_active ') && config('
        kodebazar.midtrans_id ') && config('
        kodebazar.midtrans_key ') && config('
        kodebazar.midtrans_secret ') }}'
    ) {

        const payButton = document.querySelector('#midtrans_btn');
        payButton.addEventListener('click', function (e) {
            e.preventDefault();

            snap.pay('{{ $mid_token }}', {
                onSuccess: function (result) {
                    $.ajax({
                        type: "post",
                        url: "{{ route('midtrans.success') }}",
                        data: {
                            '_token': '{{ csrf_token() }}',
                            'transaction_id': result.transaction_id,
                            'order_id': result.order_id,
                        },
                        success: function (response) {
                            window.location.href = response.redirect_url;
                        }
                    });
                },
                onPending: function (result) {
                    alert('Transaction is in pending state');
                },
                onError: function (result) {
                    alert('Transaction is failed. Try again.');
                }
            });
        });
    }
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
