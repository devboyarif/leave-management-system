<?php

namespace Database\Factories;

use App\Models\User;
use App\Models\Country;
use Illuminate\Database\Eloquent\Factories\Factory;

class CompanyFactory extends Factory
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
        ]);

        return [
            'user_id' => $user->id,
            'country_id' => Country::inRandomOrder()->value('id'),
        ];
    }
}
