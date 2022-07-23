<?php

namespace App\Http\Controllers\Admin;

use App\Models\Plan;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PlanCreateRequest;
use App\Http\Requests\Admin\PlanUpdateRequest;

class PlanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $plans = Plan::with('planFeatures')->whereStatus(1)->get();

        return inertia('admin/plan/index', [
            'plans' => $plans,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return inertia('admin/plan/create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  PlanCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PlanCreateRequest $request)
    {
        // Plan Create
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['price'] = $request->price;
        $data['status'] = $request->status ? 1 : 0;
        $data['interval'] = $request->interval;
        $data['custom_interval_days'] = $request->interval == 'custom_days' ? $request->custom_interval_days : null;
        $plan = Plan::create($data);

        // Plan Features Create
        $plan->planFeatures()->create([
            'is_limited_employee' => $request->is_limited_employee ? 1 : 0,
            'max_employees' => $request->is_limited_employee ? $request->max_employees : 1,
            'max_teams' => $request->max_teams ? $request->max_teams : 1,
            'max_leave_types' => $request->max_leave_types ? $request->max_leave_types : 1,
            'custom_theme_look' => $request->custom_theme_look ? 1 : 0,
        ]);

        session()->flash('success', 'Plan created successfully!');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Plan $plan)
    {
        return inertia('admin/plan/edit', [
            'plan' => $plan->load('planFeatures'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  PlanUpdateRequest  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PlanUpdateRequest $request, Plan $plan)
    {
        // Plan Create
        $data['name'] = $request->name;
        $data['type'] = $request->type;
        $data['price'] = $request->price;
        $data['status'] = $request->status ? 1 : 0;
        $data['interval'] = $request->interval;
        $data['custom_interval_days'] = $request->interval == 'custom_days' ? $request->custom_interval_days : null;
        $plan->update($data);

        // Plan Features Create
        $plan->planFeatures()->update([
            'is_limited_employee' => $request->is_limited_employee ? 1 : 0,
            'max_employees' => $request->is_limited_employee ? $request->max_employees : 1,
            'max_teams' => $request->max_teams ? $request->max_teams : 1,
            'max_leave_types' => $request->max_leave_types ? $request->max_leave_types : 1,
            'custom_theme_look' => $request->custom_theme_look ? 1 : 0,
        ]);

        session()->flash('success', 'Plan updated successfully!');
        return redirect_to('plans.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function setRecommended(Plan $plan)
    {
        Plan::where('recommended', 1)->update(['recommended' => 0]);
        $plan->update(['recommended' => 1]);

        session()->flash('success', 'Plan has been set as recommended.');
        return back();
    }
}
