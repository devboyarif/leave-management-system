<?php

use Nexmo\Client as NexmoClient;
use Carbon\Carbon;
use App\Models\Theme;
use AmrShawky\Currency;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Http;
use Vonage\Client\Credentials\Basic;
use Twilio\Rest\Client as TwilioClient;
use Stichoza\GoogleTranslate\GoogleTranslate;

function uploadFileToPublic(string $path, $file)
{
    if ($file && $path) {
        $url = $file->move('uploads/' . $path, $file->hashName());
    } else {
        $url = null;
    }

    return $url;
}

function currentUser()
{
    return auth()->user();
}

function currentUserRole()
{
    return auth()->user()->role;
}

function currentUserId()
{
    return auth()->id();
}

function currentCompany()
{
    return auth()->user()->company;
}

function currentEmployee()
{
    return auth()->user()->employee;
}

function getCompanyUserByEmployeeUser($user_id)
{
    $company_id = Employee::where('user_id', $user_id)->value('company_id');
    return Company::findOrFail($company_id)->user;
}

function getCompany($user_id)
{
    return Company::where('user_id', $user_id)->firstOrFail();
}

function getEmployee($user_id)
{
    return Employee::where('user_id', $user_id)->firstOrFail();
}

function getUserByCompanyId($id)
{
    return Company::where('id', $id)->firstOrFail()->user;
}

function getUserByEmployeeId($id)
{
    return Employee::where('id', $id)->firstOrFail()->user;
}

function strSlug($name)
{
    return Str::slug($name);
}

function redirect_to($name)
{
    return redirect()->route($name);
}

function addDays($date, $days, $format = 'Y-m-d')
{
    $date = Carbon::createFromFormat($format, $date);
    $daysToAdd = $days;
    return $date->addDays($daysToAdd)->format($format);
}

function formatDateTime($date, $format = 'Y-m-d')
{
    return Carbon::createFromFormat($format, $date);
}

function changeCurrentYear($date, $format = 'Y-m-d')
{
    return Carbon::parse($date)->year(now()->format('Y'))->format($format);
}

function getHolidays($country_code = 'bd')
{
    $api = config('kodebazar.google_api');
    $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/en.$country_code%23holiday%40group.v.calendar.google.com/events?key=$api";

    $response = Http::get($calendar_api);
    $holidays_list = $response->json()['items'];

    $current_year_holidays = [];

    foreach ($holidays_list as $holiday) {
        if (currentYearData($holiday['start']['date'])) {
            $current_year_holidays[] = [
                'title' => $holiday['summary'],
                'start' => $holiday['start']['date'],
                'end' => $holiday['end']['date']
            ];
        }
    }

    return $current_year_holidays;
}

function currentYearData($data, $format = 'Y-m-d')
{
    $date = Carbon::createFromFormat($format, $data)->format('Y');

    return $date == now()->format('Y') ? 1 : 0;
}

function diffBetweenDays($start_date, $end_date)
{
    $start_date = Carbon::parse(date('Y-m-d', strtotime($start_date)));
    $end_date = Carbon::parse(date('Y-m-d', strtotime($end_date)));

    return $start_date->diffInDays($end_date);
}

function formatTime($date, $format = 'Y-m-d')
{
    return Carbon::parse($date)->format($format);
}

function translations($json)
{
    if (!file_exists($json)) {
        return [];
    }
    return json_decode(file_get_contents($json), true);
}

function translateIt(String $text, $code)
{
    return GoogleTranslate::trans($text, $code, 'en');
}

function getAdminTheme()
{
    if (!session()->has('theme')) {
        $theme = Theme::first();
        session(['theme' => $theme]);
    }

    return session('theme');
}

function storeCompanyCurrentSubscription()
{
    session()->forget('current_subscription');

    if (auth()->check() && auth()->user()->role == 'company') {
        $subscription = currentCompany()->subscription->load(['plan' => function ($query) {
            $query->with('planFeatures');
        }]) ?? [];

        session(['current_subscription' => $subscription]);
    }
}

function getCurrentSubscription()
{
    // session()->forget('current_subscription');
    if (auth()->check() && auth()->user()->role == 'company') {
        if (!session()->has('current_subscription')) {
            storeCompanyCurrentSubscription();
        }

        return session('current_subscription');
    }
}

function getCurrentSubscriptionFeatures()
{
    return getCurrentSubscription()->plan->planFeatures ?? [];
}

function currencyConversion($amount, $from = null, $to = null, $round = 2)
{
    $from = $from ?? config('kodebazar.currency');
    $to = $to ?? 'USD';

    return Currency::convert()
        ->from($from)
        ->to($to)
        ->amount($amount)
        ->round($round)
        ->get();
}

function checkMailConfig()
{
    $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

    return $status ? 1 : 0;
}

function sendSms($provider, $to, $message)
{
    if ($provider == 'nexmo') {
        try {
            $basic  = new Basic(config('kodebazar.nexmo_key'), config('kodebazar.nexmo_secret'));
            $client = new NexmoClient($basic);

            $message = $client->message()->send([
                'to' => $to,
                'from' => config('kodebazar.nexmo_from_name'),
                'text' => $message
            ]);
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    } else if ($provider == 'twilio') {
        try {
            $account_sid = config('kodebazar.twilio_secret');
            $auth_token = config('kodebazar.twilio_token');
            $twilio_number = config('kodebazar.twilio_from');

            $client = new TwilioClient($account_sid, $auth_token);
            $client->messages->create($to, [
                'from' => $twilio_number,
                'body' => $message
            ]);
        } catch (Exception $e) {
            dd("Error: " . $e->getMessage());
        }
    }
}
