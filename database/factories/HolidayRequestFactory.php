<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use Illuminate\Database\Eloquent\Factories\Factory;

class HolidayRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start_date = $this->faker->dateTimeBetween('-1 week', '+1 week')->format('Y-m-d');
        $end_date = $this->faker->dateTimeBetween($start_date, '+1 week')->format('Y-m-d');

        return [
            'company_id' => Company::inRandomOrder()->value('id'),
            'employee_id' => Employee::inRandomOrder()->value('id'),
            'title' => $this->faker->sentence,
            'start' => $start_date,
            'end' => $end_date,
            'days' => diffBetweenDays($start_date, $end_date),
            'note' => $this->faker->sentence,
        ];
    }
}
