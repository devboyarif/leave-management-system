<?php

namespace App\Http\Controllers\Company;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Traits\HasSubscription;
use App\Http\Controllers\Controller;
use App\Traits\Employee\HasLeaveBalance;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Notifications\Company\NewEmployeeJoined;
use App\Http\Requests\Company\EmployeeCreateRequest;

class EmployeeController extends Controller
{
    use HasSubscription, HasLeaveBalance;

    public function index()
    {
        $teams = Team::where('company_id', currentCompany()->id)->get(['id', 'name', 'slug']);
       $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')->where('company_id', currentCompany()->id)->get();

        return inertia('company/employees', [
            'teams' => $teams,
            'employees' => $employees,
        ]);
    }

    public function store(EmployeeCreateRequest $request)
    {
        // Check if the user is limited to create employees
        if ($this->checkEmployeesLimitation()) {
            session()->flash('error', __('You have reached the maximum number of employees'));
            return back();
        }

        $company = currentCompany();

        if ($company->leaveTypes->count() == 0) {
            session()->flash('error', 'Please add leave types first');
            return redirect_to(route('leaveTypes.create'));
        }

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = User::ROLE_EMPLOYEE;
        $data['password'] = bcrypt($request->password);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $user = User::create($data);


       $employee = $user->employee()->create([
            'user_id' => $user->id,
            'company_id' => $company->id,
            'team_id' => $request->team_id,
            'phone' => $request->phone ?? '',
        ]);

        // Create leave balance for the employee
        $this->employeeLeaveBalanceCreate($company->id, $employee->id);

        $employee->company->user->notify(new NewEmployeeJoined($employee->user, $employee->company_id));

        session()->flash('success', 'Employee created successfully!');
        return back();
    }

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
        $leave_balances = $userEmployee->leaveBalances->load('leaveType:id,name');

        return inertia('company/employeeDetails',[
            'user' => $user,
            'summary' => $summary,
            'leave_balances' => $leave_balances,
        ]);
    }

    public function inviteEmployee(Request $request)
    {
        $request->validate([
            'email' => 'required|email|max:255',
            'team_id' => 'required|integer',
        ]);

        return $request;
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $user = $employee->user;

        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['role'] = User::ROLE_EMPLOYEE;
        if ($request->password) {
            $data['password'] = bcrypt($request->password);
        }

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $user->update($data);

        $user->employee()->update([
            'user_id' => $user->id,
            'company_id' => currentCompany()->id,
            'team_id' => $request->team_id,
            'phone' => $request->phone ?? '',
        ]);

        session()->flash('success', 'Employee updated successfully!');
        return back();
    }

    public function destroy(User $employee)
    {
        $employee->delete();
        $employee->employee()->delete();

        session()->flash('success', 'Employee deleted successfully!');
        return back();
    }
}
