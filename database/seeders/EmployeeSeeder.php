<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use App\Models\Employee;
use App\Models\Designation;
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
        $user = User::create([
            'name' => 'Ariful Islam',
            'email' => 'arif@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);

        Employee::create([
            'user_id' => $user->id,
            'company_id' => Company::inRandomOrder()->value('id'),
            'team_id' => Team::inRandomOrder()->value('id'),
            'designation_id' => Designation::inRandomOrder()->value('id'),
        ]);
    }
}
