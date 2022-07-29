<?php

namespace App\Http\Controllers\Admin;

use App\Traits\SettingAble;
use Illuminate\Http\Request;
use App\Mail\Admin\SmtpTestMail;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

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
        $data = [
            'host' => config('mail.mailers.smtp.host'),
            'port' => config('mail.mailers.smtp.port'),
            'encryption' => config('mail.mailers.smtp.encryption'),
            'from_name' => config('mail.from.name'),
            'from_address' => config('mail.from.address'),
            'username' => config('mail.mailers.smtp.username'),
            'password' => config('mail.mailers.smtp.password'),
        ];

        return inertia('admin/setting/smtp', [
            'data' => $data,
        ]);
    }

    public function smtpUpdate(Request $request)
    {
        $this->validate($request, [
            'host' => 'required',
            'port' => 'required',
            'encryption' => 'required',
            'from_name' => 'required',
            'from_address' => 'required',
            'username' => 'required',
            'password' => 'required',
        ]);


        checkSetEnv('MAIL_HOST', $request->host);
        checkSetEnv('MAIL_PORT', $request->port);
        checkSetEnv('MAIL_USERNAME', $request->username);
        checkSetEnv('MAIL_PASSWORD', $request->password);
        checkSetEnv('MAIL_ENCRYPTION', $request->encryption);
        checkSetEnv('MAIL_FROM_NAME', $request->from_name);
        checkSetEnv('MAIL_FROM_ADDRESS', $request->from_address);

        session()->flash('success', 'SMTP updated successfully');
        return back();
    }

    public function testEmailSend()
    {
        request()->validate(['email' => ['required', 'email']]);

        try {
            Mail::to(request()->test_email)->send(new SmtpTestMail);

            return back()->with('success', 'Test email sent successfully.');
        } catch (\Throwable $th) {
            return back()->with('error', 'Invalid email configuration. Mail send failed.');
        }
    }
}
