<?php

namespace App\Traits;

use App\Models\Seo;
use App\Models\Setting;

trait SettingAble
{
    public function getPaymentData($provider)
    {
        switch ($provider) {
            case 'paypal':
                return [
                    'paypal_sandbox_client_id' => config('paypal.sandbox.client_id'),
                    'paypal_sandbox_client_secret' => config('paypal.sandbox.client_secret'),
                    'paypal_live_client_id' => config('paypal.live.client_id'),
                    'paypal_live_client_secret' => config('paypal.live.client_secret'),
                    'paypal_active' => config('paypal.active'),
                    'paypal_mode' => config('paypal.mode'),
                ];
                break;
            case 'stripe':
                return [
                    'stripe_active' => config('kodebazar.stripe_active'),
                    'stripe_key' => config('kodebazar.stripe_key'),
                    'stripe_secret' => config('kodebazar.stripe_secret'),
                ];
                break;
            case 'razorpay':
                return [
                    'razorpay_key' => config('kodebazar.razorpay_key'),
                    'razorpay_secret' => config('kodebazar.razorpay_secret'),
                    'razorpay_active' => config('kodebazar.razorpay_active'),
                ];
                break;
            case 'flutterwave':
                return [
                    'flw_public_key' => config('kodebazar.flw_public_key'),
                    'flw_secret' => config('kodebazar.flw_secret'),
                    'flw_secret_hash' => config('kodebazar.flw_secret_hash'),
                    'flw_active' => config('kodebazar.flw_active'),
                ];
                break;
            case 'mollie':
                return [
                    'mollie_key' => config('kodebazar.mollie_key'),
                    'mollie_active' => config('kodebazar.mollie_active')
                ];
                break;
            case 'paystack':
                return [
                    'paystack_key' => config('kodebazar.paystack_key'),
                    'paystack_secret' => config('kodebazar.paystack_secret'),
                    'paystack_merchant' => config('kodebazar.paystack_merchant'),
                    'paystack_active' => config('kodebazar.paystack_active'),
                ];
                break;
            case 'instamojo':
                return [
                    'im_key' => config('kodebazar.im_key'),
                    'im_secret' => config('kodebazar.im_secret'),
                    'im_active' => config('kodebazar.im_active'),
                ];
                break;
            case 'midtrans':
                return [
                    'midtrans_id' => config('kodebazar.midtrans_id'),
                    'midtrans_key' => config('kodebazar.midtrans_key'),
                    'midtrans_secret' => config('kodebazar.midtrans_secret'),
                    'midtrans_active' => config('kodebazar.midtrans_active'),
                ];
                break;
        }
    }

    public function updatePaymentData($data)
    {
        switch ($data->provider) {
            case 'paypal':
                if ($data->paypal_mode == 1) {
                    $this->validate($data, [
                        'paypal_live_client_id' => 'required',
                        'paypal_live_client_secret' => 'required',
                    ], [
                        'paypal_live_client_id.required' => 'The paypal client id field is required',
                        'paypal_live_client_secret.required' => 'The paypal client Secret field is required',
                    ]);
                } else {
                    $this->validate($data, [
                        'paypal_sandbox_client_id' => 'required',
                        'paypal_sandbox_client_secret' => 'required',
                    ], [
                        'paypal_sandbox_client_id.required' => 'The paypal client id field is required',
                        'paypal_sandbox_client_secret.required' => 'The paypal client Secret field is required',
                    ]);
                }

                if ($data->paypal_mode) {
                    checkSetEnv('PAYPAL_LIVE_CLIENT_ID', $data->paypal_live_client_id);
                    checkSetEnv('PAYPAL_LIVE_CLIENT_SECRET', $data->paypal_live_client_secret);
                } else {
                    checkSetEnv('PAYPAL_SANDBOX_CLIENT_ID', $data->paypal_sandbox_client_id);
                    checkSetEnv('PAYPAL_SANDBOX_CLIENT_SECRET', $data->paypal_sandbox_client_secret);
                }
                setEnv('PAYPAL_MODE', $data->paypal_mode ? 'live' : 'sandbox');
                setEnv('PAYPAL_ACTIVE', $data->paypal_active ? 'true' : 'false');
                break;
            case 'stripe':
                $this->validate($data, [
                    'stripe_key' => 'required',
                    'stripe_secret' => 'required',
                ]);

                checkSetEnv('STRIPE_KEY', $data->stripe_key);
                checkSetEnv('STRIPE_SECRET', $data->stripe_secret);
                setEnv('STRIPE_ACTIVE', $data->stripe_active ? 'true' : 'false');
                break;
            case 'razorpay':
                $this->validate($data, [
                    'razorpay_key' => 'required',
                    'razorpay_secret' => 'required',
                ]);

                checkSetEnv('RAZORPAY_KEY', $data->razorpay_key);
                checkSetEnv('RAZORPAY_SECRET', $data->razorpay_secret);
                setEnv('RAZORPAY_ACTIVE', $data->razorpay_active ? 'true' : 'false');
                break;
            case 'flutterwave':
                $this->validate($data, [
                    'flw_public_key' => 'required',
                    'flw_secret' => 'required',
                    'flw_secret_hash' => 'required',
                ], [
                    'flw_public_key.required' => 'The flutterwave public key field is required',
                    'flw_secret.required' => 'The flutterwave secret field is required',
                    'flw_secret_hash.required' => 'The flutterwave secret hash field is required',
                ]);

                checkSetEnv('FLW_PUBLIC_KEY', $data->flw_public_key);
                checkSetEnv('FLW_SECRET_KEY', $data->flw_secret);
                checkSetEnv('FLW_SECRET_HASH', $data->flw_secret_hash);
                setEnv('FLW_ACTIVE', $data->flw_active ? 'true' : 'false');
                break;
            case 'mollie':
                $this->validate($data, [
                    'mollie_key' => 'required',
                ]);

                checkSetEnv('MOLLIE_KEY', $data->mollie_key);
                setEnv('MOLLIE_ACTIVE', $data->mollie_active ? 'true' : 'false');
                break;
            case 'paystack':
                $this->validate($data, [
                    'paystack_key' => 'required',
                    'paystack_secret' => 'required',
                    'paystack_merchant' => 'required',
                ], [
                    'paystack_merchant.required' => 'The paystack merchant email field is required',
                ]);

                checkSetEnv('PAYSTACK_PUBLIC_KEY', $data->paystack_key);
                checkSetEnv('PAYSTACK_SECRET_KEY', $data->paystack_secret);
                checkSetEnv('MERCHANT_EMAIL', $data->paystack_merchant);
                setEnv('PAYSTACK_ACTIVE', $data->paystack_active ? 'true' : 'false');
                break;
            case 'instamojo':
                $this->validate($data, [
                    'im_key' => 'required',
                    'im_secret' => 'required',
                ], [
                    'im_key.required' => 'The instamojo key field is required',
                    'im_secret.required' => 'The instamojo auth token field is required',
                ]);

                checkSetEnv('IM_API_KEY', $data->im_key);
                checkSetEnv('IM_AUTH_TOKEN', $data->im_secret);
                setEnv('IM_ACTIVE', $data->im_active ? 'true' : 'false');
                break;
            case 'midtrans':
                $this->validate($data, [
                    'midtrans_id' => 'required',
                    'midtrans_key' => 'required',
                    'midtrans_secret' => 'required',
                ]);

                checkSetEnv('MIDTRANS_MERCHAT_ID', $data->midtrans_id);
                checkSetEnv('MIDTRANS_CLIENT_KEY', $data->midtrans_key);
                checkSetEnv('MIDTRANS_SERVER_KEY', $data->midtrans_secret);
                setEnv('MIDTRANS_ACTIVE', $data->midtrans_active ? 'true' : 'false');
                break;
        }

        return true;
    }

    public function getSeo(){
        $seo = Seo::all();
        return $seo;
    }

    public function updateSeoContent($request, $seo){
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required',
        ]);

        $seo->update([
            'title' => $request->title,
            'description' => $request->description,
            'keywords' => $request->keywords,
        ]);

        return true;
    }

    public function updateBrandInfo($request){
        $request->validate([
            'app_name' => 'required',
            'app_email' => 'required|email',
            'app_contact_number' => 'required',
            'app_copyright' => 'required',
            'app_location' => 'required',
        ]);

        checkSetEnv('APP_NAME', $request->app_name);
        $data['app_email'] = $request->app_email;
        $data['app_contact_number'] = $request->app_contact_number;
        $data['app_copyright'] = $request->app_copyright;
        $data['app_location'] = $request->app_location;

        if ($request->hasFile('app_dark_logo') && $request->file('app_dark_logo')->isValid()) {
            $request->validate(['app_dark_logo' => 'image|mimes:jpeg,png,jpg']);
            $url = uploadFileToPublic('app_dark_logo', $request->app_dark_logo);
            $data['app_dark_logo'] = $url;
        }

        if ($request->hasFile('app_light_logo') && $request->file('app_light_logo')->isValid()) {
            $request->validate(['app_light_logo' => 'image|mimes:jpeg,png,jpg']);
            $url = uploadFileToPublic('app_light_logo', $request->app_light_logo);
            $data['app_light_logo'] = $url;
        }

        if ($request->hasFile('app_favicon') && $request->file('app_favicon')->isValid()) {
            $request->validate(['app_favicon' => 'image|mimes:jpeg,png,jpg']);
            $url = uploadFileToPublic('app_favicon', $request->app_favicon);
            $data['app_favicon'] = $url;
        }

        Setting::first()->update($data);

        return true;
    }

    public function updateSocialMedia($request){
        $request->validate([
            'facebook' => 'nullable|url',
            'twitter' => 'nullable|url',
            'linkedin' => 'nullable|url',
            'youtube' => 'nullable|url',
            'instagram' => 'nullable|url',
            'pinterest' => 'nullable|url',
        ]);

        Setting::first()->update([
            'facebook' => $request->facebook ?? '',
            'twitter' => $request->twitter ?? '',
            'linkedin' => $request->linkedin ?? '',
            'youtube' => $request->youtube ?? '',
            'instagram' => $request->instagram ?? '',
            'pinterest' => $request->pinterest ?? '',
        ]);
    }
}
