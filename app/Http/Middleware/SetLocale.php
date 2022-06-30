<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class SetLocale
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        // app()->setLocale(config('app.locale'));

        // if (session()->has('current_lang')) {
        //     app()->setLocale(session('current_lang'));
        //     info('Session locale: ' . session('current_lang'));
        // } else {
        //     info(6656465);
        // }

        $current_lang = session('current_lang');

        if (session()->has('current_lang')) {
            app()->setLocale($current_lang);
            info('1');
            info(app()->getLocale());
        } else {
            app()->setLocale(config('app.locale'));
            info('2');
            info(app()->getLocale());
        }

        return $next($request);
    }
}
