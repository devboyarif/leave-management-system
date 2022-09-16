<?php

namespace App\Http\Controllers\Company;

use App\Models\Company;
use App\Models\Country;
use App\Models\Holiday;
use App\Traits\HasCountry;
use Illuminate\Http\Request;
use App\Models\HolidayRequest;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\HolidaySaveRequest;
use App\Notifications\Company\NewHolidayRequest;

class HolidayController extends Controller
{
    use HasCountry;

    public function index()
    {
        $user = currentUser();
        $company = Company::with('country:id,name')->where('user_id', $user->id)->firstOrFail();
        $holidays = Holiday::where('company_id', $company->id)->oldest('start')->get()->transform(function ($date) {
            $date->format_start_date = formatTime($date->start, 'D d M');
            $date->format_end_date = formatTime($date->end, 'D d M');
            return $date;
        });

        return inertia('company/holiday/holidays', [
            'user' => $user,
            'company' => $company,
            'holidays' => $holidays,
        ]);
    }

    public function store(HolidaySaveRequest $request)
    {
        Holiday::create([
            'company_id' => $request->company_id,
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'color' =>  "#ff0000",
        ]);

        session()->flash('success', 'Official holiday created successfully!');
        return back();
    }

    public function update(HolidaySaveRequest $request, Holiday $holiday)
    {
        $holiday->update([
            'title' => $request->title,
            'start' => $request->start,
            'end' => $request->end,
            'days' => diffBetweenDays($request->start, $request->end),
            'color' =>  "#ff0000",
        ]);

        session()->flash('success', 'Official holiday updated successfully!');
        return back();
    }

    public function destroy(Holiday $holiday)
    {
        $holiday->delete();

        session()->flash('success', 'Holiday deleted successfully!');
        return back();
    }

    public function destroyAllHolidays()
    {
        currentCompany()->holidays()->delete();

        session()->flash('success', 'All holidays deleted successfully!');
        return back();
    }

    public function importHolidays(Request $request)
    {
        $request->validate([
            'country' => 'required|exists:countries,id',
        ]);

        $company = currentCompany();
        $country = Country::findOrFail($request->country);
        $code = $this->getCountryCode($country->code);

        if ($request->type == 'add') {
            importHolidays($company->id, $code);
        } else {
            $company->holidays()->delete();
            importHolidays($company->id, $code);
        }

        session()->flash('success', 'Holidays imported successfully!');
        return back();
    }

    public function requestedHolidays()
    {
        $company = getCompany(currentUserId());
        $holidays = HolidayRequest::where('company_id', $company->id)
            ->with('employee.user')
            ->latest()
            ->paginate(10);

        return inertia('company/holiday/holidayRequest', [
            'holidays' => $holidays,
            'company' => $company->load('country:id,name'),
            'user' => $company->user,
        ]);
    }

    public function requestedHolidaysAccept(Request $request)
    {
        $request_holiday = HolidayRequest::findOrFail($request->id);
        Holiday::create([
            'company_id' => $request_holiday->company_id,
            'title' => $request_holiday->title,
            'start' => $request_holiday->start,
            'end' => $request_holiday->end,
            'days' => diffBetweenDays($request_holiday->start, $request_holiday->end),
            'color' =>  "#ff0000",
        ]);

        $request_holiday->delete();

        session()->flash('success', 'Holiday request accepted successfully!');
        return back();
    }

    public function requestedHolidaysReject(HolidayRequest $holiday)
    {
        $holiday->delete();

        session()->flash('success', 'Holiday request rejected successfully!');
        return back();
    }
}
