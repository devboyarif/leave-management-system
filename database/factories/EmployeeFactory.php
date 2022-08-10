<?php

namespace Database\Factories;

use App\Models\Team;
use App\Models\User;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $company = Company::inRandomOrder()->first();
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png'),
            'role' => 'employee',
        ]);

        $team = $company->teams()->inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'company_id' =>  $company->id,
            'team_id' => $team->id,
            'phone' => '+8801698759865',
        ];
    }
}
