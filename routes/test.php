<?php

use App\Models\Order;
use App\Models\Setting;
use App\Models\Language;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\Admin\UpgradeController;

Route::get('/testt', [TestController::class, 'index']);

Route::get('/test', function () {

    $data['order'] = Order::first();
    $data['company'] = $data['order']->company->load('country:id,name', 'user');
    $data['subscribed_plan'] = $data['company']->subscription->load('plan.planFeatures');
    $data['setting'] = Setting::first();

    // return $data;
    // return view('testpdf', $data);

    $pdf = Pdf::loadView('generate.order-pdf', $data);
    // return $pdf->stream();

    return $pdf->download('invoice.pdf');




    // $collection = collect([19, 21, 29, 46]);

    // $filtered = $collection->filter(function ($value, $key) {
    //     return $value > 21;
    // });

    // dd($filtered->all());


    // return 645654;

    // $data['notifications'] = auth()->check() ? auth()->user()->notifications->take(5) : [];
    // $data['unreadNotificationsCount'] = auth()->check() ? auth()->user()->unreadNotifications->count() : 0;

    // return $data;
    // return $notifications = auth()->user()->unreadNotifications;
    $notifications = auth()->user()->notifications;

    return $notifications->where('notifiable_id', 3);
    // ->map(function($data){
    //     return $data->notifiable_id == 3;
    // });



    DB::flushQueryLog();
    // $album_list = Album::with(['first_photo'])->where('status', '=', '1');
    // $album_list = $album_list->get();
    $arr = DB::getQueryLog();
    dd($arr);




    return route('employee.leave.request.index');

    return auth()->user()->employee->company;
    return currentCompany()->subscription->plan->planFeatures->max_teams;
    if ($company) {
        $features = $company->subscription->plan->planFeatures;
    }else{
        $features = getCurrentSubscriptionFeatures();
        $company = currentCompany();
    }

    $total_teams = $company->teams->count() ?? 0;

    if ($total_teams >= $features->max_teams) {
        return true;
    }



    if (auth()->check() && auth()->user()->current_company_id) {
       return 'ase';
    }

    return 'nai';

    return auth()->user()->companies;
    return Language::where('status', 1)->get(['id', 'name', 'code']);
    return view('system.app_status');
})->name('test');

Route::post('update/system', [UpgradeController::class, 'updateSystem'])->name('update.system');
