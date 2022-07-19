<?php

use Carbon\Carbon;
use App\Models\Holiday;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use Illuminate\Notifications\Notification;

Route::get('language/{language}', function ($language) {
    // return $language;
    session(['current_lang' => $language]);


    $current_lang = session('current_lang');

    if (session()->has('current_lang')) {
        app()->setLocale($current_lang);
    } else {
        app()->setLocale(config('app.locale'));
    }


    return redirect()->back();
})->name('language');


Route::get('/test', function () {
    return currentCompany()->leaveTypes->count();
    return getCurrentSubscriptionFeatures()->is_limited_user;



    return $subscription = currentCompany()->subscription->load(['plan' => function ($query) {
        $query->with('planFeatures');
    }]);

    $expired_plan = formatDateTime($subscription->expired_date)->isFuture() ? false : true;

    return $expired_plan;
    return $current_subscription = $subscription;
    $current_plan = $subscription->plan;
    $current_plan_features = $subscription->plan->planFeatures;

    return [
        'current_subscription' => $current_subscription,
        'current_plan' => $current_plan,
        'current_plan_features' => $current_plan_features,
    ];


    // $current_subscription = currentCompany()->subscription;
    // $current_plan = $current_subscription->plan;
    // $current_plan_features = $current_plan->planFeatures;

    // return [
    //     'current_subscription' => $current_subscription,
    //     'current_plan' => $current_plan,
    //     'current_plan_features' => $current_plan_features,
    // ];


    return DB::table('notifications')->latest()->get();
    // return auth()->user();
    return auth()->user()->unreadNotifications->take(5);
    return auth()->user()->unreadNotifications->count();
    return $theme = getAdminTheme();
    // $user = auth()->user();

    // if ($user->role == 'company') {
    //     if (!session()->has('company_theme')) {
    //         session(['company_theme' => auth()->user()->company->theme]);
    //     }

    //     $company_theme = session('company_theme');
    // } else {
    //     if (!session()->has('company_theme')) {
    //         session(['company_theme' => auth()->user()->employee->company->theme]);
    //     }

    //     $company_theme = session('company_theme');
    // }

    // return $company_theme;


    // return session('')
    // return auth()->user();

    $text = 'Hello World ? ?';
    $before = str_replace(' ', '_', $text);
    $after = str_replace('_', ' ', $text);
    return $before . '<br>' . $after;


    return implode('_', $text);



    $arr = array('Hello World');
    return implode(" ", $arr);





    return auth()->user();


    if (!session()->has('company_theme')) {
        session(['company_theme' => auth()->user()->employee->company->theme]);
    }

    $company_theme = session('company_theme');
    return $company_theme;


    return auth()->user()->employee->company->theme;

    session(['company_theme' => auth()->user()->employee->company->theme]);



    return auth()->user()->company->theme;
    // app()->setLocale(config('app.locale'));
    // return app()->getLocale();
    $current_lang = session('current_lang');

    if (session()->has('current_lang')) {
        session(['current_lang' => 'de']);
        app()->setLocale(session('current_lang'));
    } else {
        app()->setLocale($current_lang);
    }

    return app()->getLocale();

    $old = app()->getLocale();
    app()->setLocale('dee');

    $new = app()->getLocale();

    return $old . ' -> ' . $new;
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
