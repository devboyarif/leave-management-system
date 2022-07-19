<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function diffBetweenDays(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return diffBetweenDays($start, $end);
    }

    public function notifications()
    {
        return inertia('notifications', [
            'notifications' => auth()->user()->notifications,
        ]);
    }

    public function getTranslatedMessage(Request $request)
    {
        return __($request->message);
    }
}
