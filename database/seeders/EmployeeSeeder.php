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
            'name' => 'Ariful Islam',
            'email' => 'arif@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'employee',
        ]);

        $company_id = Company::inRandomOrder()->value('id');
        $team_id = Team::inRandomOrder()->value('id');
        $employee = Employee::create([
            'user_id' => $user->id,
            'company_id' => $company_id,
            'team_id' => $team_id,
        ]);

        $leave_types = LeaveType::where('company_id', $company_id)->get();
        foreach ($leave_types as $leave_type) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
            ]);
        }

        // Employee 2
        $user2 = User::create([
            'name' => 'Employee',
            'email' => 'employee@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'employee',
        ]);

        $company2_id = Company::inRandomOrder()->value('id');
        $team2_id = Team::inRandomOrder()->value('id');
        $employee = Employee::create([
            'user_id' => $user2->id,
            'company_id' => $company2_id,
            'team_id' => $team2_id,
        ]);

        $leave_types2 = LeaveType::where('company_id', $company2_id)->get();
        foreach ($leave_types2 as $leave_type) {
            LeaveBalance::create([
                'employee_id' => $employee->id,
                'leave_type_id' => $leave_type->id,
                'total_days' => $leave_type->balance,
            ]);
        }



        // Employee::factory(14)->create()->each(function ($employee) {
        //     $leave_types2 = LeaveType::where('company_id', $employee->company2_id)->get();
        //     foreach ($leave_types2 as $leave_type) {
        //         LeaveBalance::create([
        //             'employee_id' => $employee->id,
        //             'leave_type_id' => $leave_type->id,
        //             'total_days' => $leave_type->balance,
        //         ]);
        //     }
        // });


        //     factory(App\Models\User::class, 10)->create()->each(function($u) {
        //         $u->profile()->save(factory(App\Models\UserProfile::class)->make());
        //         $u->posts()->saveMany(factory(App\Models\UserPost::class, 10)->make());

        //         // 3rd nest seeding
        //         $u->posts()->each(function($post){
        //             $post->comments()->saveMany(factory(App\Models\Comments::class, 10)->make())
        //         });
        // });



        // User::create([
        //     'email' => 'invite@mail.com',
        //     'password' => bcrypt('password'),
        //     'role' => 'employee',
        //     'isInvited' => 1,
        //     'isProfileComplete' => 0,
        // ]);
    }
}
