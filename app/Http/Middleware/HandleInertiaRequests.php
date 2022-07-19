<?php

namespace App\Http\Middleware;

use Inertia\Middleware;
use App\Models\Language;
use Illuminate\Http\Request;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request)
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request)
    {
        $data['authenticatedUser'] = currentUser();
        if (auth()->check() && currentUser()->role == 'employee') {
            $data['employeeCompanyUser'] = getCompanyUserByEmployeeUser(auth()->id());
        }

        // Flash messages
        $data['flash'] = [
            'success' => session('success'),
            'error' => session('error'),
            'warning' => session('warning')
        ];

        // Language
        $data['locale'] = session()->has('current_lang') ?  session('current_lang') : app()->getLocale();
        $data['languageList'] = Language::all(['id', 'code', 'name']);
        $data['language'] = translations(resource_path('lang/' . $data['locale'] . '.json'));

        // Notifications
        $data['notifications'] = auth()->check() ? auth()->user()->unreadNotifications->take(5) : [];
        $data['unreadNotificationsCount'] = auth()->check() ? auth()->user()->unreadNotifications->count() : 0;

        // Subscription
        if (auth()->check() && auth()->user()->role == 'company') {
            // session()->forget('current_subscription');
            if (!session()->has('current_subscription')) {
                storeCompanyCurrentSubscription();
            }

            $data['current_subscription'] = session('current_subscription');
        }

        return array_merge(parent::share($request), $data);
    }
}
