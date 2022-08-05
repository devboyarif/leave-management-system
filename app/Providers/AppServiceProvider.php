<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Setting;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();

        if (!app()->runningInConsole()) {
            // Setting
            $setting = Setting::first();
            view()->share('setting', $setting);

            // Cms
            $cms = Cms::first();
            view()->share('cms', $cms);
        }
    }
}
