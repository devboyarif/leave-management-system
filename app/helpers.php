<?php

use Carbon\Carbon;
use App\Models\Seo;
use App\Models\Theme;
use App\Models\Invite;
use AmrShawky\Currency;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Setting;
use App\Models\Employee;
use Carbon\CarbonPeriod;
use App\Models\WorkingDay;
use Illuminate\Support\Str;
use msztorc\LaravelEnv\Env;
use Nexmo\Client as NexmoClient;
use Illuminate\Support\Facades\App;
use App\Mail\Company\InviteSendMail;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Mail;
use Vonage\Client\Credentials\Basic;
use Illuminate\Support\Facades\Artisan;
use Twilio\Rest\Client as TwilioClient;
use Stichoza\GoogleTranslate\GoogleTranslate;

if (!function_exists('uploadFileToPublic')) {
    function uploadFileToPublic(string $path, $file)
    {
        if ($file && $path) {
            $url = $file->move('uploads/' . $path, $file->hashName());
        } else {
            $url = null;
        }

        return $url;
    }
}

if (!function_exists('currentUser')) {
    function currentUser()
    {
        return auth()->user();
    }
}

if (!function_exists('currentUserRole')) {
    function currentUserRole()
    {
        return auth()->user()->role;
    }
}

if (!function_exists('currentUserId')) {
    function currentUserId()
    {
        return auth()->id();
    }
}

if (!function_exists('currentCompany')) {
    function currentCompany()
    {
       return Company::find(auth()->user()->current_company_id);
        // return auth()->user()->companies;
    }
}

if (!function_exists('currentCompany')) {
    function ownerCompanies()
    {
       return Company::find(auth()->user()->current_company_id);
        // return auth()->user()->companies;
    }
}

if (!function_exists('currentEmployee')) {
    function currentEmployee()
    {
        return auth()->user()->employee;
    }
}

if (!function_exists('getCompanyUserByEmployeeUser')) {
    function getCompanyUserByEmployeeUser($user_id)
    {
        $company_id = Employee::where('user_id', $user_id)->value('company_id');
        return Company::findOrFail($company_id)->user;
    }
}

if (!function_exists('getCompany')) {
    function getCompany($user_id)
    {
        return Company::where('user_id', $user_id)->firstOrFail();
    }
}

if (!function_exists('getEmployee')) {
    function getEmployee($user_id)
    {
        return Employee::where('user_id', $user_id)->firstOrFail();
    }
}

if (!function_exists('getUserByCompanyId')) {
    function getUserByCompanyId($id)
    {
        return Company::where('id', $id)->firstOrFail()->user;
    }
}

if (!function_exists('getUserByEmployeeId')) {
    function getUserByEmployeeId($id)
    {
        return Employee::where('id', $id)->firstOrFail()->user;
    }
}

if (!function_exists('strSlug')) {
    function strSlug($name)
    {
        return Str::slug($name);
    }
}

if (!function_exists('redirect_to')) {
    function redirect_to($name)
    {
        return redirect()->route($name);
    }
}

if (!function_exists('addDays')) {
    function addDays($date, $days, $format = 'Y-m-d')
    {
        $date = Carbon::createFromFormat($format, $date);
        $daysToAdd = $days;
        return $date->addDays($daysToAdd)->format($format);
    }
}

if (!function_exists('formatDateTime')) {
    function formatDateTime($date, $format = 'Y-m-d')
    {
        return Carbon::createFromFormat($format, $date);
    }
}

if (!function_exists('changeCurrentYear')) {
    function changeCurrentYear($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->year(now()->format('Y'))->format($format);
    }
}

if (!function_exists('getHolidays')) {
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
                    'end' => subDays($holiday['end']['date'])
                ];
            }
        }

        return $current_year_holidays;
    }
}

if (!function_exists('currentYearData')) {
    function currentYearData($data, $format = 'Y-m-d')
    {
        $date = Carbon::createFromFormat($format, $data)->format('Y');

        return $date == now()->format('Y') ? 1 : 0;
    }
}

if (!function_exists('translations')) {
    function translations($json)
    {
        if (!file_exists($json)) {
            return [];
        }
        return json_decode(file_get_contents($json), true);
    }
}

if (!function_exists('translateIt')) {
    function translateIt(String $text, $code)
    {
        return GoogleTranslate::trans($text, $code, 'en');
    }
}

if (!function_exists('getAdminTheme')) {
    function getAdminTheme()
    {
        if (!session()->has('theme')) {
            $theme = Theme::first();
            session(['theme' => $theme]);
        }

        return session('theme');
    }
}

if (!function_exists('storeCompanyCurrentSubscription')) {
    function storeCompanyCurrentSubscription()
    {
        session()->forget('current_subscription');

        if (auth()->check() && auth()->user()->role == 'owner') {
            if (!function_exists('get_file_size')) {
                $subscription = currentCompany()->subscription->load(['plan' => function ($query) {
                    $query->with('planFeatures');
                }]) ?? [];

                session(['current_subscription' => $subscription]);
            }
        }
    }
}

if (!function_exists('getCurrentSubscription')) {
    function getCurrentSubscription()
    {
        // session()->forget('current_subscription');
        if (auth()->check() && auth()->user()->role == 'owner') {
            if (!session()->has('current_subscription')) {
                storeCompanyCurrentSubscription();
            }

            return session('current_subscription');
        }
    }
}

if (!function_exists('getCurrentSubscriptionFeatures')) {
    function getCurrentSubscriptionFeatures()
    {
        return getCurrentSubscription()->plan->planFeatures ?? [];
    }
}

if (!function_exists('currencyConversion')) {
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
}

if (!function_exists('currencyPosition')) {

    function currencyPosition($amount)
    {
        $symbol = config('kodebazar.currency_symbol');
        $position = config('kodebazar.currency_symbol_position');

        if ($position == 'left') {
            return $symbol . ' ' . $amount;
        } else {
            return $amount . ' ' . $symbol;
        }

        return $amount;
    }
}

if (!function_exists('checkMailConfig')) {
    function checkMailConfig()
    {
        $status = config('mail.mailers.smtp.transport') && config('mail.mailers.smtp.host') && config('mail.mailers.smtp.port') && config('mail.mailers.smtp.username') && config('mail.mailers.smtp.password') && config('mail.mailers.smtp.encryption') && config('mail.from.address') && config('mail.from.name');

        return $status ? 1 : 0;
    }
}

if (!function_exists('setting')) {
    function setting($fields = null, $append = false)
    {
        if ($fields) {
            $type = gettype($fields);

            if ($type == 'string') {
                $data = $append ? Setting::first($fields) : Setting::value($fields);
            } elseif ($type == 'array') {
                $data = Setting::first($fields);
            }
        } else {
            $data = Setting::first();
        }

        if ($append) {
            $data = $data->makeHidden(['logo_image_url', 'logo_image2_url', 'favicon_image_url']);
        }

        return $data;
    }
}

if (!function_exists('sendSms')) {
    function sendSms($provider, $to, $message)
    {
        if ($provider == 'vonage' && config('kodebazar.vonage_active') && $to && $message) {
            try {
                $basic  = new Basic(config('kodebazar.vonage_key'), config('kodebazar.vonage_secret'));
                $client = new NexmoClient($basic);

                $message = $client->message()->send([
                    'to' => $to,
                    'from' => config('kodebazar.vonage_from_name'),
                    'text' => $message
                ]);
            } catch (Exception $e) {
                dd("Error: " . $e->getMessage());
            }
        } else if ($provider == 'twilio' && config('kodebazar.twilio_active') && $to && $message) {
            try {
                $account_sid = config('kodebazar.twilio_secret');
                $auth_token = config('kodebazar.twilio_token');
                $twilio_number = config('kodebazar.twilio_from');

                $client = new TwilioClient($account_sid, $auth_token);
                $client->messages->create($to, [
                    'from' => '+' . $twilio_number,
                    'body' => $message
                ]);
            } catch (Exception $e) {
                dd("Error: " . $e->getMessage());
            }
        }
    }
}

if (!function_exists('setEnv')) {
    function setEnv($key, $value)
    {
        if ($key && $value) {
            $env = new Env();
            $env->setValue($key, $value);
        }

        if (file_exists(App::getCachedConfigPath())) {
            Artisan::call("config:cache");
        }
    }
}

if (!function_exists('checkSetEnv')) {
    function checkSetEnv($key, $value)
    {
        if ((env($key) != $value)) {
            setEnv($key, $value);
        }
    }
}

if (!function_exists('metaContent')) {
    function metaContent($page)
    {
        return Seo::where('page_slug', $page)->first();
    }
}

if (!function_exists('importHolidays')) {
    function importHolidays($company_id, $country_code)
    {
        try {
            $holidays = getHolidays($country_code);
        } catch (\Throwable $th) {
            // throw $th;
        }

        if (isset($holidays) && count($holidays)) {
            for ($i = 0; $i < count($holidays); $i++) {
                $holiday_data[] = [
                    'company_id' => $company_id,
                    'title' => $holidays[$i]['title'],
                    'start' => $holidays[$i]['start'],
                    'end' => $holidays[$i]['end'],
                    'days' => diffBetweenDays($holidays[$i]['start'], $holidays[$i]['end']),
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }

            $holiday_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

            foreach ($holiday_chunks as $country) {
                Holiday::insert($country);
            }
        }
    }
}

if (!function_exists('diffBetweenDays')) {
    function diffBetweenDays($start_date, $end_date)
    {
        $days = CarbonPeriod::since($start_date)->days(1)->until($end_date);
        return count($days);
    }
}

if (!function_exists('daysPeriods')) {
    function daysPeriods($start_date, $end_date)
    {
        $days_periods = CarbonPeriod::create($start_date, $end_date)->map(fn ($date) => $date->toDateString());
        return iterator_to_array($days_periods);
    }
}

if (!function_exists('subDays')) {
    function subDays($date, $days = 1, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->subDay($days)->format($format);
    }
}

if (!function_exists('formatTime')) {
    function formatTime($date, $format = 'Y-m-d')
    {
        return Carbon::parse($date)->format($format);
    }
}

if (!function_exists('weekly_holidays')) {
    function weekly_holidays($company_holidays)
    {
        $week_days = ['sunday', 'monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday'];

        $weekly_holidays = [];

        if ($week_days && $company_holidays) {
            foreach ($week_days as $week_day) {
                if (!$company_holidays->$week_day) {
                    $weekly_holidays[] = $week_day;
                }
            }
        }

        return $weekly_holidays;
    }
}

if (!function_exists('official_holidays')) {
    function official_holidays($company_id, $start_date, $end_date)
    {
        $holidays = [];
        $holidays_between_days = Holiday::where('company_id', $company_id)
            ->whereDate('start', '>=', $start_date)
            ->whereDate('end', '<=', $end_date)
            ->get(['start', 'end']);

        foreach ($holidays_between_days as $holiday) {
            $holidays = array_merge($holidays, iterator_to_array(CarbonPeriod::create($holiday->start, $holiday->end)->map(fn ($date) => $date->toDateString())));
        }

        $holidays = array_values(array_unique($holidays));

        return $holidays;
    }
}

if (!function_exists('sumWeekendDays')) {
    function sumWeekendDays($days_periods, $weekly_holidays)
    {
        $total_days = 0;

        foreach ($days_periods as $day) {
            $day_name = mb_strtolower(Carbon::parse($day)->format('l'));

            if (in_array($day_name, $weekly_holidays)) {
                $total_days++;
            }
        }

        return $total_days;
    }
}

if (!function_exists('sumOfficialHolidays')) {
    function sumOfficialHolidays($days_periods, $holidays)
    {
        $total_days = 0;

        foreach ($days_periods as $day) {
            if (in_array($day, $holidays)) {
                $total_days++;
            }
        }

        return $total_days;
    }
}

if (!function_exists('sumDaysBetweenDates')) {
    function sumDaysBetweenDates($company_id, $start_date, $end_date)
    {
        $start_date = $start_date;
        $end_date = $end_date;
        $days_periods = daysPeriods($start_date, $end_date);
        $total_days = count($days_periods);

        // Holidays
        $holidays = official_holidays($company_id, $start_date, $end_date);
        $official_holidays = sumOfficialHolidays($days_periods, $holidays);

        // Weekly Off days
        $company_holidays = WorkingDay::where('company_id', $company_id)->first();
        $weekly_holidays = weekly_holidays($company_holidays);
        $weekend_days = sumWeekendDays($days_periods, $weekly_holidays);

        return [
            'days_count' => $total_days,
            'official_holidays_count' => $official_holidays,
            'weekend_days_count' => $weekend_days,
            'final_days_count' => $total_days - $official_holidays - $weekend_days,
        ];
    }
}

if (!function_exists('sumFinalDays')) {
    function sumFinalDays($company_id, $start_date, $end_date)
    {
        $start_date = $start_date;
        $end_date = $end_date;
        $days_periods = daysPeriods($start_date, $end_date);
        $total_days = count($days_periods);

        // Holidays
        $holidays = official_holidays($company_id, $start_date, $end_date);
        $official_holidays = sumOfficialHolidays($days_periods, $holidays);

        // Weekly Off days
        $company_holidays = WorkingDay::where('company_id', $company_id)->first();
        $weekly_holidays = weekly_holidays($company_holidays);
        $weekend_days = sumWeekendDays($days_periods, $weekly_holidays);

        return $total_days - $official_holidays - $weekend_days;
    }
}

if (!function_exists('currentLanguage')) {
    function currentLanguage()
    {
        return session('current_lang');
    }
}

if (!function_exists('sendInvite')) {
    function sendInvite($company_id,$email, $team_id)
    {
        $data['token'] = Str::random(60);
        $data['company_id'] = $company_id;
        $data['team_id'] = $team_id;
        $data['email'] = $email;

        if (!Invite::whereToken($data['token'])->exists()) {
            $invite = Invite::create($data);
        } else {
            $data['token'] = Str::random(100);
            $invite = Invite::create($data);
        }

        // send the email
        Mail::to($email)->send(new InviteSendMail($invite));
    }
}
