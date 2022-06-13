<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
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

        Employee::create([
            'user_id' => $user->id,
            'company_id' => Company::inRandomOrder()->value('id'),
            'team_id' => Team::inRandomOrder()->value('id'),
        ]);

        // Employee 2
        $user2 = User::create([
            'name' => 'Employee',
            'email' => 'employee@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'employee',
        ]);

        Employee::create([
            'user_id' => $user2->id,
            'company_id' => Company::inRandomOrder()->value('id'),
            'team_id' => Team::inRandomOrder()->value('id'),
        ]);

        Employee::factory(14)->create();

        User::create([
            'email' => 'invite@mail.com',
            'password' => bcrypt('password'),
            'role' => 'employee',
            'isInvited' => 1,
            'isProfileComplete' => 0,
        ]);
    }
}
