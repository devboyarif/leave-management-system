<?php

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\Calendar;
use App\Models\Employee;
use App\Models\LeaveBalance;
use Illuminate\Support\Arr;
use App\Models\LeaveRequest;
use App\Models\LeaveType;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;

Route::get('/test', function () {
    $employee = currentEmployee();
    $company = $employee->company;
    $leave_requests = LeaveRequest::where('company_id', $employee->company_id)->get();

    return     $pending_leave_requests = $leave_requests->where('status', 'pending')->load('leaveType')->transform(function ($leaveRequest) {
        return [
            'type' => $leaveRequest->leaveType->name,
            'start' => formatTime($leaveRequest->start, 'D d M'),
            'end' => formatTime($leaveRequest->end, 'D d M'),
            'days' => $leaveRequest->days,
            'status' => $leaveRequest->status,
            'color' => $leaveRequest->leaveType->color,

        ];
    });


    // $leaveRequest = $leave_requests->load('leaveType', 'employee.user')
    //     ->where('status', 'approved')
    //     ->transform(function ($leaveRequest) {
    //         return [
    //             'title' => $leaveRequest->employee->user->name,
    //             'end' => $leaveRequest->end,
    //             'start' => $leaveRequest->start,
    //             'color' => $leaveRequest->leaveType->color,
    //         ];
    //     });

    // $total_leave_request = $leave_requests->where('status', 'approved')->count();
    // $pending_leave_request = $leave_requests->where('status', 'pending')->count();
    // $total_teams = $company->teams->count();
    // $total_employees = $company->employees->count();

    return $leave_requests->where('status', 'pending')->load('leaveType');
    return [
        'events' => $leaveRequest,
        'total_leaves' => $total_leave_request,
        'total_pending_leaves' => $pending_leave_request,
        'total_teams' => $total_teams,
        'total_employees' => $total_employees,
    ];


    // $company = currentEmployee()->company;
    // $leave_requests = LeaveRequest::where('company_id', $company->id)->get();
    // $total_leave_request = $leave_requests->where('status', 'approved')->count();
    // $pending_leave_request = $leave_requests->where('status', 'pending')->count();
    // $total_teams = $company->teams->count();
    // $total_employees = $company->employees->count();

    // return [
    //     'total_leaves' => $total_leave_request,
    //     'total_pending_leaves' => $pending_leave_request,
    //     'total_teams' => $total_teams,
    //     'total_employees' => $total_employees,
    // ];



    $employee = currentEmployee()->leaveBalances;


    $leave_balances = $employee->load('leaveType:id,name')->transform(function ($leaveBalance) {
        $total_days = $leaveBalance->total_days;
        $used_days = $leaveBalance->used_days;
        $remaining_days = $leaveBalance->remaining_days;

        return [
            'title' => $leaveBalance->leaveType->name,
            'total_days' => $total_days,
            'used_days' => $used_days,
            'remaining_days' => $remaining_days,
            'user_percentage' => round(($used_days / $total_days) * 100),
            'remaining_percentage' => round(($remaining_days / $total_days) * 100),
        ];
    });

    return $leave_balances;

    // $employee = currentEmployee();
    // $leave_types = LeaveType::where('company_id', $employee->company_id)->get();
    // // $total_days = $leave_types->balance;

    // foreach ($leave_types as $leave_type) {
    //     LeaveBalance::create([
    //         'employee_id' => $employee->id,
    //         'leave_type_id' => $leave_type->id,
    //         'total_days' => $leave_type->balance,
    //     ]);
    // }


    // return $employee->leaveBalances;



    // return LeaveType::get();
    // $employee = currentCompany();





    return $leaveRequest = LeaveRequest::with('leaveType', 'employee.user')
        ->where('company_id', $company->company_id)
        ->where('status', 'approved')
        ->get()
        ->transform(function ($leaveRequest) {
            return [
                'title' => $leaveRequest->company->user->name,
                'end' => $leaveRequest->end,
                'start' => $leaveRequest->start,
                'color' => $leaveRequest->leaveType->color,
            ];
        });

    $employee = currentEmployee();
    $leave_type_color = LeaveType::where('company_id', $employee->company_id)->get(['name', 'color']);
    $holiday = [
        [
            'name' => 'Holiday',
            'color' => '#ff0000'
        ]
    ];

    return    $array = Arr::collapse([$holiday, $leave_type_color]);

    // return $array = Arr::collapse([[1, 2, 3], [4, 5, 6], [7, 8, 9], [1, 2, 3]]);
    // [1, 2, 3, 4, 5, 6, 7, 8, 9]


    $holidays = Holiday::where('company_id', 4)
        ->get()
        ->transform(function ($holiday) {
            return [
                'title' => $holiday->title,
                'start' => $holiday->start,
                'end' => $holiday->end,
                'color' => $holiday->color,
            ];
        });

    $leaveRequest = LeaveRequest::with('leaveType', 'employee.user')
        ->where('company_id', 4)
        ->where('status', 'approved')
        ->get()
        ->transform(function ($leaveRequest) {
            return [
                'title' => $leaveRequest->employee->user->name,
                'end' => $leaveRequest->end,
                'start' => $leaveRequest->start,
                'color' => $leaveRequest->leaveType->color,
            ];
        });

    return Arr::collapse([$holidays, $leaveRequest]);

    $merged = $holidays->merge($leaveRequest);

    return $merged->all();

    // $collection = collect(['Desk', 'Chair']);

    // $merged = $collection->merge(['Bookcase', 'Door']);

    // $merged->all();



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
