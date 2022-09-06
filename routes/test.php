<?php

use App\Http\Controllers\Admin\UpgradeController;
use App\Http\Controllers\TestController;
use App\Models\Language;
use Illuminate\Support\Facades\Route;

Route::get('/testt', [TestController::class, 'index']);

Route::get('/test', function () {

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
