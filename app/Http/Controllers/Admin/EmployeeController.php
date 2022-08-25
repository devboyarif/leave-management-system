<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use Illuminate\Http\Response;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Traits\Employee\HasLeaveBalance;
use App\Http\Requests\EmployeeCreateRequest;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Models\LeaveBalance;

class EmployeeController extends Controller
{
    use HasSubscription, HasLeaveBalance;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $search = request('search') ?? '';
        $company = request('company') ?? '';

        $employees = Employee::with('user:id,name,email', 'company.user:id,name')
            ->when($search, function ($query, $search) {
                $query->whereHas('user', function ($query) use ($search) {
                    $query->where('name', 'LIKE', '%' . $search . '%')
                        ->orWhere('email', 'LIKE', '%' . $search . '%');
                });
            })
            ->when($company, function ($query, $company) {
                $query->where('company_id', $company);
            })
            ->latest()
            ->paginate(10)
            ->withQueryString()
            ->through(fn ($employee) => [
                'id' => $employee->id,
                'user_id' => $employee->user_id,
                'name' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $employee->user->name) : $employee->user->name,
                'email' => $search ? preg_replace('/(' . $search . ')/i', "<b class='bg-warning'>$1</b>", $employee->user->email) : $employee->user->email,
                'avatar' => $employee->user->avatar,
                'phone' => $employee->phone ?? '',
                'company' => $employee->company->user->name,
                'company_id' => $employee->company_id,
            ]);

        $companies = Company::with('user:id,name')->get()->map(function ($company) {
            return [
                'id' => $company->id,
                'name' => $company->user->name,
            ];
        });

        return inertia('admin/employee/index', [
            'employees' => $employees,
            'companies' => $companies,
            'filters' => [
                'search' => $search ?? '',
                'company' => $company ?? '',
            ],
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companies = Company::with('user:id,name')->get();

        return inertia('admin/employee/create', [
            'companies' => $companies,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  UserCreateRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(EmployeeCreateRequest $request)
    {
        $company = Company::findOrFail($request->company_id);

        if ($company->leaveTypes->count() == 0) {
            session()->flash('error', 'Please add leave types first');
            return redirect_to(route('leaveTypes.create'));
        }

        // Check if the user is limited to create employees
        if ($this->checkEmployeesLimitation($company)) {
            session()->flash('error', __('You have reached the maximum number of employees'));
            return back();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'role' => User::ROLE_EMPLOYEE,
            'password' => bcrypt($request->password),
        ]);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $user->update(['avatar' => $url]);
        }

        $employee = $user->employee()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'team_id' => $request->team_id,
            'phone' => $request->phone ?? '',
        ]);

        // Create leave balance for the employee
        $this->employeeLeaveBalanceCreate($company->id, $employee->id);

        session()->flash('success', 'Employee created successfully!');
        return redirect_to('employees.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $employee)
    {
        $user = $employee;
        $userEmployee = $user->employee;
        $user->load('employee.team:id,name');

        // Company summary
        $leave_requests = $userEmployee->leaveRequests;
        $summary = [
             'total_rejected_leave_requests' => $leave_requests->where('status','rejected')->count(),
             'total_pending_leave_requests' => $leave_requests->where('status','pending')->count(),
             'total_approved_leave_requests' => $leave_requests->where('status','approved')->count(),
         ];

        // Leave balance
        // return $leave_balances = LeaveBalance::where('employee_id', $userEmployee->id)->get();
        $leave_balances = $userEmployee->leaveBalances->load('leaveType:id,name');

        return inertia('admin/employee/show',[
            'user' => $user,
            'summary' => $summary,
            'leave_balances' => $leave_balances,
        ]);


    //     $userCompany = $user->company;
    //     $user->load('company.country:id,name');

    //     // Working days
    //     $working_days = $userCompany->workingDays;

    //     // Company summary
    //     $leave_requests = $userCompany->leaveRequests;
    //     $summary = [
    //         'total_expense' => currencyConversion(Order::where('company_id', $userCompany->id)->sum('usd_amount'), 'USD', $userCompany->currency) ?? 0,
    //         'total_teams' => $userCompany->teams()->count(),
    //         'total_employees' => $userCompany->employees()->count(),
    //         'total_holidays' => $userCompany->holidays()->count(),
    //         'total_leave_types' => $userCompany->leaveTypes()->count(),
    //         'total_rejected_leave_requests' => $leave_requests->where('status','rejected')->count(),
    //         'total_pending_leave_requests' => $leave_requests->where('status','pending')->count(),
    //         'total_approved_leave_requests' => $leave_requests->where('status','approved')->count(),
    //     ];

    //     // Currently Subscription
    //    $subscribed_plan = $userCompany->subscription->load('plan.planFeatures');

        // return inertia('admin/company/show', [
        //     'user' => $company,
        //     'working_days' => $working_days,
        //     'summary' => $summary,
        //     'subscribed_plan' => $subscribed_plan,
        // ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $employee)
    {
        $user = $employee;
        $employee = $user->employee;
        $companies = Company::with('user:id,name')->get();
        $teams = $employee->company->teams;

        return inertia('admin/employee/edit', [
            'user' => $user,
            'employee' => $employee,
            'companies' => $companies,
            'teams' => $teams,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $data = $request->except(['phone', 'company_id', 'team_id', '_method']);
        $data['role'] = User::ROLE_EMPLOYEE;
        if ($request->password) {
            $data['password'] = bcrypt($data['password']);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $employee->user()->update($data);

        $employee->update([
            'company_id' => $request->company_id,
            'team_id' => $request->team_id,
            'phone' => $request->phone ?? '',
        ]);

        session()->flash('success', 'Employee updated successfully!');
        return redirect()->route('employees.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user->delete();

        session()->flash('success', 'Employee deleted successfully!');
        return back();
    }
}
