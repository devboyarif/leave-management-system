<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use App\Models\Country;
use App\Models\TeamSize;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function diffBetweenDays(Request $request)
    {
        $company_id = $request->company_id;
        $start = $request->start;
        $end = $request->end;

        return sumDaysBetweenDates($company_id, $start, $end);
    }

    public function contactMessages()
    {
        $messages = ContactMessage::latest()->paginate(10);

        return inertia('admin/others/messages', [
            'messages' => $messages,
        ]);
    }

    public function contactMessageDelete(ContactMessage $message)
    {
        $message->delete();

        session()->flash('success', 'Message deleted successfully.');
        return back();
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

    public function error403()
    {
        return inertia('errors/403');
    }

    public function allCountries()
    {
        return Country::all(['id', 'name']);
    }

    public function allTeamSizes()
    {
        return TeamSize::all(['id', 'name']);
    }

    public function appSetting()
    {
        return setting();
    }

    public function useridWiseCompany(Request $request)
    {
        return getCompany($request->user_id);
    }

    public function switchLanguage($language)
    {
        session()->put('current_lang', $language);

        return back();
    }

    public function markAsReadNotification()
    {
        auth()->user()->unreadNotifications->markAsRead();
    }
}
