<?php

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\Calendar;
use App\Models\Employee;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    // return inertia('test/login');
    return redirect()->route('dashboard');
    return inertia('index');
});

Route::get('/test', function () {
    // return auth()->user()->employee->team->employees->load('user');
    // $employee = currentUser()->employee;
    // $team = $employee->team;
    // $company = $employee->company;
    // $employees = $team->employees->load('user');
    $company = currentUser()->employee->team;
    return $employeeUsers = Employee::with('user:id,name,avatar', 'team:id,name')
        ->where('team_id', $company->id)
        ->get();


    return [
        'employee' => $employee,
        'team' => $team,
        'company' => $company,
        'employees' => $employees,
    ];




    return getHolidays('indian');

    $holidays = Holiday::where('company_id', 3)->oldest('start')->get()->transform(function ($date) {
        $date->format_start_date = formatTime($date->start, 'D d M');
        $date->format_end_date = formatTime($date->end, 'D d M');
        return $date;
    });

    return $holidays;



    $formatedHolidays = $holidays->map(function ($data) {
        $date->start = Carbon::parse($date->start)->format('Y-m-d');
        $data->format_start_date = formatTime($date->start, 'D d M');

        return $data;
    });

    return $formatedHolidays;


    // return $date = Carbon::parse('2022-12-25')->format("D d M");




    // $date = Carbon::parse(date('Y-m-d', strtotime('2022-12-25')));;

    // return $date->format('D d M');
    // return Carbon::tomorrow()->format('l');



    // get from and throung date
    $from_date = Carbon::parse(date('Y-m-d', strtotime('2022-12-25')));
    $through_date = Carbon::parse(date('Y-m-d', strtotime('2022-12-27')));
    // $from_date = Carbon::parse(date('Y-m-d', strtotime('2022-03-10')));
    // $through_date = Carbon::parse(date('Y-m-d', strtotime('2022-03-12')));
    // $from_date = '2022-03-10';
    // $through_date = '2022-03-12';

    // get total number of minutes between from and throung date
    return  $shift_difference = $from_date->diffInDays($through_date);

    // will output $shift_difference = 2



    $then = "2022-06-01";
    $now = Carbon::now()->toDateString();

    return $now->diffInDays($then);
    // {{ now()->diffInDays($car->buy_date) }}





    return getHolidays('usa');
    return $country = Country::where('code', 'bd')->first();
    return  strtolower('ASCKJJKLJHKJHJKH');
    $calendars = Calendar::all()
        ->transform(fn ($user) => [
            'id' => $user->id,
            'title' => $user->title,
            'start' => $user->start,
            'end' => addDays($user->end, 1),
            'color' => $user->color,
        ]);

    return inertia('test/calendar', [
        'events' => $calendars,
    ]);
})->name('test');

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
