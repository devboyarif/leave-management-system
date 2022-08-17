<?php

use App\Http\Controllers\TestController;
use Carbon\Carbon;
use App\Models\Team;
use App\Models\User;
use App\Models\Order;
use App\Models\Company;
use App\Models\Holiday;
use App\Models\Setting;
use Twilio\Rest\Client;
use App\Models\Employee;
use App\Models\WeekDays;
use App\Traits\HasAdmin;
use Carbon\CarbonPeriod;
use App\Models\WorkingDay;
use App\Models\LeaveRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/testt', [TestController::class, 'index']);

Route::get('/test', function () {
    // $total_income = currencyConversion(Order::sum('usd_amount'), 'USD', config('kodebazar.currency')) ?? 0;
    // $total_companies = Company::count();
    // $total_teams = Team::count();
    // $total_employees = Employee::count();

    // return [
    //     'total_income' => $total_income,
    //     'total_companies' => $total_companies,
    //     'total_teams' => $total_teams,
    //     'total_employees' => $total_employees,
    // ];

    $months = Order::select(
        \DB::raw('MIN(created_at) AS created_at'),
        \DB::raw('sum(usd_amount) as `amount`'),
        \DB::raw("DATE_FORMAT(created_at,'%M') as month")
    )
        ->where("created_at", ">", \Carbon\Carbon::now()->startOfYear())
        ->orderBy('created_at')
        ->groupBy('month')
        ->get();

    $amountArray = [];
    $monthArray = [];

    foreach ($months as $value) {
        array_push($amountArray, currencyConversion($value->amount, 'USD', config('kodebazar.currency')));
        array_push($monthArray, $value->month);
    }

    return ['amount' => $amountArray, 'months' => $monthArray];




















    $start_date = '2022-05-25';
    $end_date = '2022-05-31';
    return sumDaysBetweenDates(1,$start_date, $end_date);

    $days_periods = daysPeriods($start_date, $end_date);
    $total_days = count($days_periods);
    $final_total_days = 0;

    // Holidays
    $holidays = official_holidays(1,$start_date, $end_date);
    $official_holidays = sumOfficialHolidays($days_periods, $holidays);

    // Weekly Off days
    $company_holidays = WorkingDay::where('company_id', 1)->first();
    $weekly_holidays = weekly_holidays($company_holidays);
    $weekend_days = sumWeekendDays($days_periods, $weekly_holidays);

    return [
        'start_date' => $start_date,
        'end_date' => $end_date,
        'days_period' => $days_periods,
        'total_days' => $total_days,
        'official_holidays' => $official_holidays,
        'weekend_days' => $weekend_days,
        'final_total_days' => $total_days - $official_holidays - $weekend_days,
    ];








    // =====================================================================
    // ======================Weekly Holidays Remove=========================
    // =====================================================================
    $company_holidays = WorkingDay::first();
    $weekly_holidays = weekly_holidays($company_holidays);
    $without_holidays = [];
    $with_holidays = [];

    foreach ($days_periods as $key => $day) {
        $day_name = mb_strtolower(Carbon::parse($day)->format('l'));

        if (!in_array($day_name, $weekly_holidays)) {
            $final_total_days++;
            $with_holidays[] = $day.' '.$day_name;
        }else{
            $without_holidays[] = $day.' '.$day_name;
        }
    }

    return [
        'start_date' => $start_date,
        'end_date' => $end_date,
        'days_period' => $days_periods,
        'total_days' => $total_days,
        'final_total_days' => $final_total_days,
        'weekly_holidays' => $weekly_holidays,
    ];























    // // =====================================================================
    // // ======================Official Holidays Remove=========================
    // // =====================================================================
    // $start_date = '2022-05-25';
    // $end_date = '2022-05-31';
    // $days_periods = CarbonPeriod::create($start_date, $end_date)->map(fn ($date) => $date->toDateString());
    // $days_periods = iterator_to_array($days_periods);
    // $total_days = count($days_periods);

    // $final_total_days = 0;
    // $without_holidays = [];
    // $with_holidays = [];
    // $holidays = [];

    // $holidays_between_days = Holiday::where('company_id', 1)
    //         ->whereDate('start', '>=', $start_date)
    //         ->whereDate('end', '<=', $end_date)
    //         ->get(['start','end']);

    // foreach ($holidays_between_days as $holiday) {
    //     $holidays = array_merge($holidays, iterator_to_array(CarbonPeriod::create($holiday->start, $holiday->end)->map(fn ($date) => $date->toDateString())));
    // }

    // $holidays = array_values(array_unique($holidays));

    // foreach ($days_periods as $key => $day) {
    //     if (!in_array($day, $holidays)) {
    //         $final_total_days++;
    //         $with_holidays[] = $day;
    //     }else{
    //         $without_holidays[] = $day;
    //     }
    // }

    // return [
    //     'start_date' => $start_date,
    //     'end_date' => $end_date,
    //     'days_period' => $days_periods,
    //     'total_days' => $total_days,
    //     'final_total_days' => $final_total_days,
    //     'holidays' => $holidays,
    //     'with_holidays' => $with_holidays,
    //     'without_holidays' => $without_holidays,
    // ];









    // // =====================================================================
    // // ======================Weekly Holidays Remove=========================
    // // =====================================================================
    // $company_holidays = WorkingDay::first();
    // $start_date = '2022-05-25';
    // $end_date = '2022-05-29';
    // $days_periods = CarbonPeriod::create($start_date, $end_date)->map(fn ($date) => $date->toDateString());
    // $days_periods = iterator_to_array($days_periods);
    // $total_days = count($days_periods);

    // $final_total_days = 0;
    // $weekly_holidays = weekly_holidays($company_holidays);
    // $without_holidays = [];
    // $with_holidays = [];

    // foreach ($days_periods as $key => $day) {
    //     $day_name = mb_strtolower(Carbon::parse($day)->format('l'));

    //     if (!in_array($day_name, $weekly_holidays)) {
    //         $final_total_days++;
    //         $with_holidays[] = $day.' '.$day_name;
    //     }else{
    //         $without_holidays[] = $day.' '.$day_name;
    //     }
    // }

    // return [
    //     'start_date' => $start_date,
    //     'end_date' => $end_date,
    //     'days_period' => $days_periods,
    //     'total_days' => $total_days,
    //     'final_total_days' => $final_total_days,
    //     'weekly_holidays' => $weekly_holidays,
    //     'with_holidays' => $with_holidays,
    //     'without_holidays' => $without_holidays,
    // ];























    $start_date = '2022-05-25';
    $end_date = '2022-05-28';

    $start_day = date("D", strtotime($start_date));
    $end_day = date("D", strtotime($end_date));

    $start = Carbon::parse($start_date);
    $end = Carbon::parse($end_date);
    $total_days = $end->diffInDays($start) + 1;

    // Gets the working days in comma seperated without the key from the database [Example: Sat, Sun, Mon, Tue, Wed, Thu] in array
    $working_days = WorkingDay::where('working_status', 0)
        ->get(['day'])->map(function ($day) {
            return $day->day;
        })->toArray();

    // Gets the holidays in comma seperated dates without the key from the database [Example: 2022-05-26, 2022-05-28] in array
    $holidays = Holiday::where('publication_status', 1)->get(['date'])->map(function ($date) {
        return date('Y-m-d', strtotime($date->date));
    })->toArray();

    // Get the weekend holidays we get between the start date and end date by the helper function we created
    $weekend_holidays = $this->sumHolidays($working_days, $start_date, $total_days, 'weekends');

    // Get the holidays if have any between the start date and end date by the helper function we created
    $monthly_holidays = $this->sumHolidays($holidays, $start_date, $total_days, 'holidays');

    $total_leaves = $total_days - $weekend_holidays - $monthly_holidays + 1; //need solution here;





















    $start_date = '2022-05-25';
    $end_date = '2022-05-28';
    $total_days = CarbonPeriod::create($start_date, $end_date)->count();

    $official_holiday = 1;
    $weekly_off = 1;

    $total_days = $total_days - $official_holiday - $weekly_off;
    return $total_days;







    $start_date = '2022-05-25';
    $end_date = '2022-05-28';

    // return $start_day = mb_strtolower(date("l", strtotime($start_date))); // monday
    $start_day = date("D", strtotime($start_date));
    $end_day = date("D", strtotime($end_date));

    // this is change
    $start = strtotime($start_date);
    $end = strtotime($end_date);
    $diff = $end - $start;
    // This will calculate days between two days including start date and end date
    return  $diff_in_days = floor($diff / (60 * 60 * 24)) + 1;
    // assuming Fri is holiday and get count of it
    $weekly_holidays = 1;
    // $weekly_holidays = WorkingDay::where('working_status', 1)
    //     ->get(['day'])->count();
    // Get count of monthly holidays
    $monthly_holidays = 1;
    // $monthly_holidays = Holiday::where('publication_status', 1)->get(['date'])->count();
    // your result will be 4
    $total_days = $diff_in_days - $weekly_holidays - $monthly_holidays;













    $start = '2020-01-01';
    $end = '2020-01-31';

    $startDate = new DateTime($start);
    $endDate = new DateTime($end);
    $interval = new DateInterval('P1D');
    $dateRange = new CarbonPeriod($startDate, $endDate, $interval);
    // return $dateRange;

    return $holidays = Holiday::where('company_id', 1)->get();




    $results = [];
    foreach ($dateRange as $date) {
        $name = $date->format('l');
        if (in_array($name, $workday) && !in_array($date->format('Y-m-d'), $holidays)) {
            $results[] = $date->format('Y-m-d');
        }
    }
    return $results;




    // $dates = CarbonPeriod::create('2022-08-01', '2022-08-15')
    //     ->filter(fn ($date) => !$date->isSunday())
    //     ->map(fn ($date) => $date->toDateString());
    // $dates = iterator_to_array($dates);
    // return $dates;



    $company = Company::first();
    $workdays = $company->workingDays;
    return $workdays;

    // "monday": 1,
    // "tuesday": 1,
    // "wednesday": 1,
    // "thursday": 1,
    // "friday": 1,
    // "saturday": 1,
    // "sunday": 0,


    $dates = CarbonPeriod::create('2022-08-01', '2022-08-10')->filter(function ($date) use ($workdays) {
        if (!$workdays->monday && $date->isMonday()) {
            return false;
        }
        if (!$workdays->tuesday && $date->isTuesday()) {
            return false;
        }

        if (!$workdays->wednesday && $date->isWednesday()) {
            return false;
        }

        if (!$workdays->thursday && $date->isThursday()) {
            return false;
        }

        if (!$workdays->friday && $date->isFriday()) {
            return false;
        }

        if (!$workdays->saturday && $date->isSaturday()) {
            return false;
        }

        if (!$workdays->sunday && $date->isSunday()) {
            return false;
        }

        return true;




        return !$date->isFriday();
    })->map(function ($date) {
        return $date->toDateString();
    });
    $dates = iterator_to_array($dates);
    return $dates;













    $holidays = getHolidays('bd');
    return $holidays;


    $data = '2022-08-03';

    return subDays($data);
    $date = Carbon::parse($data)->subDay(1)->format('Y-m-d');

    return $date;

    $period = CarbonPeriod::create($start, $end);
    return $period;


    // return $holidays = getHolidays('bd');
    $country_code = 'bd';
    $api = config('kodebazar.google_api');
    $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/en.$country_code%23holiday%40group.v.calendar.google.com/events?key=$api";

    $response = Http::get($calendar_api);
    return $holidays_list = $response->json()['items'];



    // $dates = CarbonPeriod::since('2022-08-01')->days(1)->until('2022-08-07');
    // $datesWithoutSundays = collect($dates)->filter(function ($date) {
    //     return !$date->isSunday();
    // })->map(function ($date) {
    //     return ['date' => $date->format('Y-m-d')];
    // });

    // return count($dates);








    // $date = Carbon::now();
    // return $date->isFriday();

    // $dates = CarbonPeriod::since('2022-08-01')->days(1)->until('2022-08-12');

    // $datesWithoutSundays = collect($dates)->filter(function ($date) {
    //     return !$date->isSunday();
    // })->map(function ($date) {
    //     return ['date' => $date->format('Y-m-d')];
    // });

    // return [
    //     'dates' => $datesWithoutSundays,
    //     'datesWithoutSundays' => $datesWithoutSundays
    // ];



    // $dates = CarbonPeriod::create('2022-08-01', '2022-08-15')->filter(function ($date) {
    //     return !$date->isFriday();
    // })->map(function ($date) {
    //     return $date->toDateString();
    // });
    // $dates = iterator_to_array($dates);
    // return $dates;


    // $dates = CarbonPeriod::create('2022-08-01', '2022-08-15')
    //     ->filter(fn ($date) => !$date->isSunday())
    //     ->map(fn ($date) => $date->toDateString());
    // $dates = iterator_to_array($dates);
    // return $dates;












    return setting();
    $leaveRequest = new LeaveRequest();
    $employee_id = currentEmployee()->id;
    return $leaveRequest->employeeReport($employee_id)->thisWeek()->get();


    $leaveRequest = new LeaveRequest();
    $company = currentCompany();

    $team_id = 12;

    return $leaveRequest->companyTeamReport(4, 12)->thisWeek()->get();


    return $leaveRequest->companyTeamReport($company->id, 12)->thisWeek()->get();

    return $leaveRequest->where('company_id', $company->id)->whereHas('employee', function ($query) use ($team_id) {
        $query->where('team_id', $team_id);
    })->get();
    // return $leaveRequest->whereHas(['employee' => function ($query) use ($team_id){
    //     $query->where('team_id', $team_id);
    // }])->get();

    // ->with(['employee' => function($q){
    //     $q->where('team_id', 12);
    // }])->thisWeek()->get();
    // return $leaveRequest->thisWeek()->get();

    // return $leaveRequest->companyEmployeeReport(4,36)->thisWeek()->get();

    return [
        'this_week' => [
            'start_date' => now()->startOfWeek()->format('Y-m-d'),
            'end_date' => now()->endOfWeek()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->thisWeek()->count(),
        ],
        'last_week' => [
            'start_date' => now()->startOfWeek()->subWeek()->format('Y-m-d'),
            'end_date' => now()->startOfWeek()->subWeek()->endOfWeek()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->lastWeek()->count(),
        ],
        'this_month' => [
            'start_date' => now()->startOfMonth()->format('Y-m-d'),
            'end_date' => now()->endOfMonth()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->thisMonth()->count(),
        ],
        'last_month' => [
            'start_date' => now()->startOfMonth()->subMonth()->format('Y-m-d'),
            'end_date' => now()->startOfMonth()->subMonth()->endOfMonth()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->lastMonth()->count(),
        ],
        'this_year' => [
            'start_date' => now()->startOfYear()->format('Y-m-d'),
            'end_date' => now()->endOfYear()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->thisYear()->count(),
        ],
        'last_year' => [
            'start_date' => now()->startOfYear()->subYear()->format('Y-m-d'),
            'end_date' => now()->startOfYear()->subYear()->endOfYear()->format('Y-m-d'),
            'leave_requests' => $leaveRequest->lastYear()->count(),
        ],
    ];





    $path = base_path('resources/json/currency.json');
    return $currencyInfos = json_decode(file_get_contents($path), true);


    return inertia('test/demo');
    return Setting::first();
    $search = 'employee';

    $admin = User::roleAdmin()
        ->where(function ($query) use ($search) {
            $query->where('name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        })
        ->get();

    return $admin;





    // $admins = User::roleAdmin();

    // if ($search) {
    //     ->where(function($query) use ($search){
    //         $query->where('first_name', 'LIKE', '%'.$search.'%')
    //               ->orWhere('last_name', 'LIKE', '%'.$search.'%')
    //               ->orWhere('email', 'LIKE', '%'.$search.'%');
    //     })
    // }

    // return $admins->get();

    // return $admins->paginate(10);



    $users = User::select("*")
        ->where('status', 1)
        ->where(function ($query) use ($search) {
            $query->where('first_name', 'LIKE', '%' . $search . '%')
                ->orWhere('last_name', 'LIKE', '%' . $search . '%')
                ->orWhere('email', 'LIKE', '%' . $search . '%');
        })
        ->get();



    $search = 'employee';

    return $admins = User::query()
        ->when($search, function ($query, $search) {
            $query->where('name', 'Like', "%{$search}%")
                ->orWhere('email', 'Like', "%{$search}%");
        })
        ->where('role', 'admin')
        ->latest()
        ->paginate(10)
        ->withQueryString()
        ->through(fn ($user) => [
            'id' => $user->id,
            'name' => $user->name,
            'email' => $user->email,
            'avatar' => $user->avatar,
        ]);








    $keyword = 'admin';

    $searchres = User::where('name', 'LIKE', "%$keyword%")
        ->get()
        ->map(function ($row) use ($keyword) {
            $row->name = preg_replace('/(' . $keyword . ')/i', "<b>$1</b>", $row->name);
            return $row;
        });

    return $searchres;
    return view('frontend.ft_list', compact('searchres'));


    $search = 'tes';

    $admins = User::query();
    $admins->where('name', 'Like', "%{$search}%");

    $admins = $admins->where('role', 'admin')->latest()->paginate(10)->withQueryString()->through(fn ($user) => [
        'id' => $user->id,
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->avatar,
    ]);

    return $admins;

    return $admins = User::query()
        ->when(request('search'), function ($query, $search) {
            $query->where('name', 'Like', "%{$search}%");
        })
        ->roleAdmin()
        ->latest()
        ->get();



    return [
        'paypal_sandbox_client_id' => config('paypal.sandbox.client_id'),
        'paypal_sandbox_client_secret' => config('paypal.sandbox.client_secret'),
        'paypal_live_client_id' => config('paypal.live.client_id'),
        'paypal_live_client_secret' => config('paypal.live.client_secret'),
        'paypal_active' => config('paypal.active'),
        'paypal_mode' => config('paypal.mode'),
    ];

    // 'active'    => env('PAYPAL_ACTIVE', false), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    // 'mode'    => env('PAYPAL_MODE', 'sandbox'), // Can only be 'sandbox' Or 'live'. If empty or invalid, 'live' will be used.
    // 'sandbox' => [
    //     'client_id'         => env('PAYPAL_SANDBOX_CLIENT_ID', ''),
    //     'client_secret'     => env('PAYPAL_SANDBOX_CLIENT_SECRET', ''),
    //     'app_id'            => 'APP-80W284485P519543T',
    // ],
    // 'live' => [
    //     'client_id'         => env('PAYPAL_LIVE_CLIENT_ID', ''),
    //     'client_secret'     => env('PAYPAL_LIVE_CLIENT_SECRET', ''),
    //     'app_id'            => env('PAYPAL_LIVE_APP_ID', ''),
    // ],


    return setting('default_sms');
    // return env("TWILIO_SID");
    // return inertia('test/sms');

    // --------Twilio SMS----------
    $receiverNumber = "+8801681729831";
    $message = "This is testing from ileave.test";

    try {
        $account_sid = "ACa33f135544a5481b26fc567c9d3bfec9";
        $auth_token = "56285f9c55ec06fc71b3a5092bd1b1d1";
        $twilio_number = "+19707158867";

        $client = new Client($account_sid, $auth_token);
        $client->messages->create($receiverNumber, [
            'from' => $twilio_number,
            'body' => $message
        ]);

        dd('SMS Sent Successfully.');
    } catch (Exception $e) {
        dd("Error: " . $e->getMessage());
    }


    // --------Nexmo SMS----------
    $basic  = new \Nexmo\Client\Credentials\Basic('b1f8cebd', 'gn3znoS8Y3wF4MYQ');
    $client = new \Nexmo\Client($basic);

    $message = $client->message()->send([
        'to' => '+8801681729831',
        'from' => 'John Doe',
        'text' => 'A simple hello message sent from Vonage SMS API'
    ]);

    dd('SMS message has been delivered.');
})->name('test');

Route::get('/test2', function () {

    $languages = [
        [
            'name' => 'English',
            'code' => 'en',
        ],
        [
            'name' => 'Germen',
            'code' => 'de',
        ]
    ];

    return view('website.test', compact('languages'));
    // app()->setLocale(config('app.locale'));
    // return app()->getLocale();
    // $current_lang = session('current_lang');

    // if (session()->has('current_lang')) {
    //     session(['current_lang' => 'de']);
    //     app()->setLocale(session('current_lang'));
    // } else {
    //     app()->setLocale($current_lang);
    // }

    // return app()->getLocale();

    // $old = app()->getLocale();
    // app()->setLocale('dee');

    // $new = app()->getLocale();

    // return $old . ' -> ' . $new;
})->name('test');

Route::post('change/language', function () {
    $language = request('language');
    session(['current_lang' => $language]);
    app()->setLocale($language);
    return back();
})->name('change.language');

Route::get('/holiday', function () {

    return getHolidays('bd');

    $current_year_holidays = [];

    foreach ($holidays_list as $holiday) {
        if (currentYearData($holiday['start']['date'])) {
            $current_year_holidays[] = $holiday;
        }
    }
    // $start_date = Carbon::parse($holiday['start']['date']);
    // $end_date = Carbon::parse($holiday['end']['date']);
    // $current_year_holidays[] = [
    //     'title' => $holiday['summary'],
    //     'start' => $start_date->format('Y-m-d'),
    //     'end' => $end_date->format('Y-m-d'),
    //     'color' => '#ff0000',
    // ];

    return $current_year_holidays;


    $holidays = Holiday::all()
        ->transform(fn ($user) => [
            'id' => $user->id,
            'title' => $user->title,
            'start' => $user->start,
            'end' => addDays($user->end, 1),
            'color' => $user->color,
        ]);

    return inertia('test/holiday', [
        'events' => $holidays,
    ]);



    return Carbon::parse('2020-01-11')->year(now()->format('Y'))->format('Y-m-d');
    // $api = "AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k";
    // $country_code = 'bd';
    // $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k/events";

    $api = "AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k";
    $country_code = 'bd';
    $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/en.$country_code%23holiday%40group.v.calendar.google.com/events?key=$api";

    // $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/en.BD%23holiday%40group.v.calendar.google.com/events?key=AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k";

    $response = Http::get($calendar_api);

    $holidays_list = $response->json()['items'];

    for ($i = 0; $i < count($holidays_list); $i++) {
        $holiday_data[] = [
            'title' => $holidays_list[$i]['summary'],
            'start' => $holidays_list[$i]['start']['date'],
            'end' => $holidays_list[$i]['end']['date']
        ];
    }

    $calendar_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

    foreach ($calendar_chunks as $country) {
        Holiday::insert($country);
    }



    return Holiday::all();



    return gettype($response->json()['items']);
    return [
        'items' => $response->json()['items'],
        'summary' => $response->json()['items'][0]['summary'],
        'start' => $response->json()['items'][0]['start']['date'],
        'end' => $response->json()['items'][0]['end']['date'],
    ];
});
