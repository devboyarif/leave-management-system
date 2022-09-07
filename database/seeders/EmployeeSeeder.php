<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveType;
use App\Models\LeaveBalance;
use Illuminate\Database\Seeder;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Employee
        $user = User::create([
            'name' => 'Employee',
            'email' => 'employee@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'employee',
        ]);

        $kodebazarCompany = Company::where('company_email', 'kodebazar@gmail.com')->first();
        $team = $kodebazarCompany->teams->first();
        $employee = Employee::create([
            'user_id' => $user->id,
            'company_id' => $kodebazarCompany->id,
            'team_id' => $team->id,
            'phone' => '+8801681729831',
        ]);

        $leave_types = LeaveType::where('company_id', $kodebazarCompany->id)->get();
        foreach ($leave_types as $leave_type) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
                'used_days' => rand(0, $leave_type->balance),
            ]);
        }

        // Employee 2
        $company = Company::inRandomOrder()->first();
        $user2 = User::create([
            'name' => 'Ariful Islam',
            'email' => 'arif@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'employee',
        ]);

        $team2 = $company->teams->first();
        $employee = Employee::create([
            'user_id' => $user2->id,
            'company_id' => 4,
            'team_id' => $team2->id,
            'phone' => '+8801681729831',
        ]);

        $leave_types2 = LeaveType::where('company_id', 4)->get();
        foreach ($leave_types2 as $leave_type) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
                'used_days' => rand(0, $leave_type->balance),
            ]);
        }

        Employee::factory(50)->create()->each(function ($employee) {
            $leave_types = LeaveType::where('company_id', $employee->company_id)->get();
            foreach ($leave_types as $leave_type) {
                LeaveBalance::create([
                    'employee_id' => $employee->id,
                    'leave_type_id' => $leave_type->id,
                    'total_days' => $leave_type->balance,
                    'used_days' => rand(0, $leave_type->balance),
                ]);
            }
        });
    }
}
