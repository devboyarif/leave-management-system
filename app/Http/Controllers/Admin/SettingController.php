<?php

namespace App\Http\Controllers\Admin;

use App\Traits\SettingAble;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    use SettingAble;

    public function general()
    {
        return inertia('admin/setting/general');
    }

    public function cms()
    {
        return inertia('admin/setting/cms');
    }

    public function currency()
    {
        return inertia('admin/setting/currency');
    }

    public function payment()
    {
        return inertia('admin/setting/payment');
    }

    public function paymentData(Request $request)
    {
        return $this->getPaymentData($request->provider);
    }

    public function paymentDataUpdate(Request $request)
    {
        $update = $this->updatePaymentData($request);

        if ($update) {
            session()->flash('success', 'Payment data updated successfully');
            return back();
        } else {
            session()->flash('error', 'Something went wrong');
            return back();
        }
    }

    public function seo()
    {
        return inertia('admin/setting/seo');
    }

    public function smtp()
    {
        return inertia('admin/setting/smtp');
    }
}
