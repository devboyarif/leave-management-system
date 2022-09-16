<?php

namespace App\Http\Controllers\Admin;

use App\Models\Seo;
use App\Models\Setting;
use App\Traits\SettingAble;
use Illuminate\Http\Request;
use App\Mail\Admin\SmtpTestMail;
use App\Http\Controllers\Controller;
use App\Models\Cms;
use App\Models\Currency;
use Illuminate\Support\Facades\Mail;
use ZipArchive;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    use SettingAble;

    public function general()
    {
        $setting = Setting::first();
        $sms_settings = $this->getSmsSetting();

        return inertia('admin/setting/general', compact('setting', 'sms_settings'));
    }

    public function generalSettingUpdate(Request $request)
    {
        switch ($request->type) {
            case 'brand_info':
                $this->updateBrandInfo($request);
                break;
            case 'social_media':
                $this->updateSocialMedia($request);
                break;
            case 'sms':
                $this->updateSmsSetting($request);
                break;

            default:
                session()->flash('error', 'Something went wrong!');
                return back();
                break;
        }

        session()->flash('success', 'Setting updated successfully!');
        return back();
    }

    public function cms()
    {
        $cms = Cms::first();

        return inertia('admin/setting/cms', compact('cms'));
    }

    public function cmsUpdate(Request $request)
    {
        $update = $this->updateCmsData($request);

        if ($update) {
            session()->flash('success', 'CMS content updated successfully');
            return back();
        } else {
            session()->flash('error', 'Something went wrong');
            return back();
        }
    }

    public function currency()
    {
        $data = $this->getCurrencyData();

        return inertia('admin/setting/currency', $data);
    }

    public function storeCurrency(Request $request)
    {
        $this->storeCurrencyData($request);

        session()->flash('success', 'Currency added successfully');
        return back();
    }

    public function updateCurrency(Request $request, Currency $currency)
    {
        $this->updateCurrencyData($request, $currency);

        session()->flash('success', 'Currency updated successfully');
        return back();
    }

    public function deleteCurrency(Currency $currency)
    {
        $this->deleteCurrencyData($currency);

        session()->flash('success', 'Currency deleted successfully');
        return back();
    }

    public function statusUpdateCurrency(Currency $currency)
    {
        $this->statusUpdateCurrencyData($currency);

        session()->flash('success', 'Currency status updated successfully.');
        return back();
    }

    public function defaultCurrency(Currency $currency)
    {
        $this->setDefaultCurrency($currency);

        session()->flash('success', 'Currency default set successfully.');
        return back();
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
        $seo_data = $this->getSeo();

        return inertia('admin/setting/seo', [
            'seo_data' => $seo_data
        ]);
    }

    public function seoUpdate(Request $request, Seo $seo)
    {
        $seo_data = $this->updateSeoContent($request, $seo);

        if ($seo_data) {
            session()->flash('success', 'Seo content updated successfully');
            return back();
        } else {
            session()->flash('error', 'Something went wrong');
            return back();
        }
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

    public function upgrade()
    {
        return inertia('admin/setting/upgrade');
    }

    public function upgradeSystem(Request $request)
    {
        $request->validate([
            'upgrade_zip' => 'required|mimes:zip',
        ]);

        if ($request->hasFile('upgrade_zip')) {
            $time_start = microtime(true);

            if (class_exists('ZipArchive')) {

                // Create update directory.
                $dir = 'updates';
                if (!is_dir($dir))
                    mkdir($dir, 0777, true);

                $path = Storage::disk('local')->put('updates', $request->upgrade_zip);
                uploadFileToPublic('system', $request->upgrade_zip);

                //Unzip uploaded update file and remove zip file.
                $zip = new ZipArchive();
                $res = $zip->open(storage_path('app/' . $path));

                if ($res === true) {
                    $res = $zip->extractTo(base_path());
                    // $res = $zip->extractTo(base_path() . "/unzip");
                    $zip->close();

                    // Delete zip file.
                    if (file_exists(storage_path('app/' . $path))) {
                        unlink(storage_path('app/' . $path));
                    }

                    $time_end = microtime(true);
                    $execution_time = ($time_end - $time_start);
                    info('Execution time: ' . $execution_time . ' seconds');

                    if ($res) {
                        session()->flash('success', 'Update successfully installed.');
                        return back();
                    } else {
                        session()->flash('error', 'Something went wrong.');
                        return back();
                    }
                } else {
                    session()->flash('error', 'Could not open the updates zip file');
                    return back();
                }

                session()->flash('error', 'Something went wrong.');
                return back();
            } else {
                session()->flash('error', 'Please enable ZipArchive extension from server');
                return back();
            }
        }

        session()->flash('error', 'no file selected');
        return back();
    }
}
