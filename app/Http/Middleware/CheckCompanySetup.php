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
        $user = auth()->check() ? $request->user() : '';
        if ($user && $user->role == 'owner' && !$user->is_opening_setup_complete) {
            return redirect()->route('company.account.setup');
        }

        return $next($request);
    }
}
