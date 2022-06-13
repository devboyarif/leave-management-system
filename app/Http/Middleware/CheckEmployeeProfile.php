<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckEmployeeProfile
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
        // if (auth()->check() && !auth()->user()->role == 'employee') {
        //     if (auth()->user()->isInvited && !auth()->user()->isProfileComplete) {
        //         return redirect()->route('employee.setup-profile');
        //     }
        // }

        return $next($request);
    }
}
