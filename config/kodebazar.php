<?php

return [
    'app_version' => env('APP_VERSION', '1.0.0'),

    'google_api' => env('GOOGLE_API_KEY', 'AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k'),

    'default_language' => env('APP_DEFAULT_LANGUAGE'),
    'timezone' => env('APP_TIMEZONE'),
    'currency' => env('APP_CURRENCY'),
    'currency_symbol' => env('APP_CURRENCY_SYMBOL'),
    'currency_symbol_position' => env('APP_CURRENCY_SYMBOL_POSITION'),

    // Payment Provider
    'stripe_key' => env('STRIPE_KEY'),
    'stripe_secret' => env('STRIPE_SECRET'),
    'stripe_active' => env('STRIPE_ACTIVE'),

    'razorpay_key' => env('RAZORPAY_KEY'),
    'razorpay_secret' => env('RAZORPAY_SECRET'),
    'razorpay_active' => env('RAZORPAY_ACTIVE'),

    'paystack_key' => env('PAYSTACK_PUBLIC_KEY'),
    'paystack_secret' => env('PAYSTACK_SECRET_KEY'),
    'paystack_merchant' => env('MERCHANT_EMAIL'),
    'paystack_active' => env('PAYSTACK_ACTIVE'),

    'flw_public_key' => env('FLW_PUBLIC_KEY'),
    'flw_secret' => env('FLW_SECRET_KEY'),
    'flw_secret_hash' => env('FLW_SECRET_HASH'),
    'flw_active' => env('FLW_ACTIVE'),

    'im_key' => env('IM_API_KEY'),
    'im_secret' => env('IM_AUTH_TOKEN'),
    'im_active' => env('IM_ACTIVE'),

    'midtrans_id' => env('MIDTRANS_MERCHAT_ID'),
    'midtrans_key' => env('MIDTRANS_CLIENT_KEY'),
    'midtrans_secret' => env('MIDTRANS_SERVER_KEY'),
    'midtrans_active' => env('MIDTRANS_ACTIVE'),

    'mollie_key' => env('MOLLIE_KEY'),
    'mollie_active' => env('MOLLIE_ACTIVE'),

    // SMS Provider
    'twilio_secret' => env('TWILIO_SID'),
    'twilio_token' => env('TWILIO_TOKEN'),
    'twilio_from' => env('TWILIO_FROM'),
    'twilio_active' => env('TWILIO_ACTIVE'),

    'vonage_key' => env('VONAGE_KEY'),
    'vonage_secret' => env('VONAGE_SECRET'),
    'vonage_from_name' => env('VONAGE_FROM_NAME'),
    'vonage_active' => env('VONAGE_ACTIVE'),
];
