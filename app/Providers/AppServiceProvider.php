<?php

namespace App\Providers;

use App\Models\Cms;
use App\Models\Setting;
use App\Models\Language;
use Illuminate\Support\Facades\DB;
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

            // Language
            $default_language = config('kodebazar.default_language');
            $header_languages = Language::where('status', 1)->get(['id', 'name', 'code']);
            view()->share('header_languages', $header_languages);
            view()->share('defaultLanguage', $default_language);
        }

        // DB::listen(function ($query) {
        //     info($query->sql);     // the query being executed
        //     info($query->time);    // query time in milliseconds
        // });
    }
}
