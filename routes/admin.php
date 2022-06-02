<?php

use Carbon\Carbon;
use App\Models\Country;
use App\Models\Holiday;
use App\Models\Calendar;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\TeamController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\EmployeeController;
use App\Http\Controllers\Admin\LeaveTypeController;

Route::middleware('auth')->prefix('admin')->group(function () {
    Route::get('/test', function () {
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

        // return currentYearData('2021-12-08');


        // $myDate = '2022-12-08';
        // $date = Carbon::createFromFormat('Y-m-d', $myDate)->format('Y');

        // return $date == now()->format('Y') ? 'true' : 'false';


        $api = "AIzaSyAUPpqerpKmENrKzgpr_pzcmiSKE58cA7k";
        $country_code = 'bd';
        $calendar_api = "https://www.googleapis.com/calendar/v3/calendars/en.$country_code%23holiday%40group.v.calendar.google.com/events?key=$api";

        $response = Http::get($calendar_api);

        $holidays_list = $response->json()['items'];

        $current_year_holidays = [];

        foreach ($holidays_list as $holiday) {
            return $holiday['start']['date'];
            if (currentYearData($holiday['start']['date'])) {
                $current_year_holidays[] = $holiday;
            }else{
                return 12313;
            }


            // $start_date = Carbon::parse($holiday['start']['date']);
            // $end_date = Carbon::parse($holiday['end']['date']);
            // $current_year_holidays[] = [
            //     'title' => $holiday['summary'],
            //     'start' => $start_date->format('Y-m-d'),
            //     'end' => $end_date->format('Y-m-d'),
            //     'color' => '#ff0000',
            // ];
        }

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


    Route::get('/about', function () {
        return inertia('about');
    })->name('about');

    Route::get('/contact', function () {
        return inertia('contact');
    })->name('contact');

    Route::get('/dashboard', function () {
        return inertia('dashboard');
    })->name('dashboard')->middleware('auth');

    // Admins
    Route::resource('/admins', UserController::class);

    // Companies
    Route::resource('/companies', CompanyController::class);
    Route::get('/companies/teams/{user}', [CompanyController::class, 'companiesTeams'])->name('companies.teams');

    // Employees
    Route::resource('/employees', EmployeeController::class);

    // Teams
    Route::resource('/teams', TeamController::class);

    // Leave Types
    Route::resource('/leaveTypes', LeaveTypeController::class);

    // Profile & Settings
    Route::controller(UserController::class)->group(function () {
        Route::get('/profile', 'profile')->name('user.profile');
        Route::post('/profile/update', 'profileUpdate')->name('user.profile.update');
        Route::post('/password/update', 'passwordUpdate')->name('user.password.update');
    });
});
