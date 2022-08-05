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
        $user = User::create([
            'name' => $this->faker->name,
            'email' => $this->faker->unique()->safeEmail,
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png'),
            'role' => 'employee',
        ]);

        return [
            'user_id' => $user->id,
            'company_id' => Company::inRandomOrder()->value('id'),
            'team_id' => Team::inRandomOrder()->value('id'),
        ];
    }
}
