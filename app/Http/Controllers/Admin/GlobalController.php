<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;
use Illuminate\Http\Request;

class GlobalController extends Controller
{
    public function diffBetweenDays(Request $request)
    {
        $start = $request->start;
        $end = $request->end;

        return diffBetweenDays($start, $end);
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


}
