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
        $teams = Team::where('company_id', currentCompany()->id)->get(['id', 'name', 'slug']);
        $employees = Employee::with('user:id,name,email,avatar', 'team:id,name')->where('company_id', currentCompany()->id)->get();

        return inertia('company/employees', [
            'teams' => $teams,
            'employees' => $employees,
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
