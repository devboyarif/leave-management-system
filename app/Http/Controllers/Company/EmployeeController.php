<?php

namespace App\Http\Controllers\Company;

use App\Models\Team;
use App\Models\User;
use App\Models\Employee;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\EmployeeUpdateRequest;
use App\Http\Requests\Company\EmployeeCreateRequest;

class EmployeeController extends Controller
{
    public function index()
    {
        $current_company_id = currentCompany()->id;
        $employees = Employee::with('user:id,name,email,avatar')
            ->where('company_id', $current_company_id)->paginate(10);

        $teams = Team::where('company_id', $current_company_id)->get(['id', 'name']);

        return inertia('company/employees', [
            'employees' => $employees,
            'teams' => $teams,
        ]);
    }

    public function store(EmployeeCreateRequest $request)
    {
        $data = $request->all();
        $data['role'] = User::ROLE_EMPLOYEE;
        $data['password'] = bcrypt($data['password']);

        if ($request->hasFile('avatar') && $request->file('avatar')->isValid()) {
            $request->validate([
                'avatar' => ['image', 'mimes:jpeg,png,jpg'],
            ]);
            $url = uploadFileToPublic('avatars', $request->avatar);
            $data['avatar'] = $url;
        }

        $user = User::create($data);

        $user->employee()->create([
            'user_id' => $user->id,
            'company_id' => currentCompany()->id,
            'team_id' => $request->team_id,
        ]);

        session()->flash('success', 'Employee created successfully!');
        return back();
    }

    public function update(EmployeeUpdateRequest $request, Employee $employee)
    {
        $user = $employee->user;

        $data = $request->all();
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

        $user->update($data);

        $user->employee()->update([
            'user_id' => $user->id,
            'company_id' => currentCompany()->id,
            'team_id' => $request->team_id,
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
