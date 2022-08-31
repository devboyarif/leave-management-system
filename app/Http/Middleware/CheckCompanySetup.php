<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckCompanySetup
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
        // Please note here complete = 1 means company has completed his profile
        if (auth()->check() && auth()->user()->role == 'owner') {
            if (!isset(currentCompany()) || !currentCompany()->is_opening_setup_complete) {
                return redirect()->route('company.account.setup');
            }
            // return inertia('company/setup/index');
        }


        return $next($request);
    }
}
