<?php

namespace Database\Factories;

use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Factories\Factory;

class CalendarFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $start = $this->faker->dateTimeBetween('next Monday', 'next Monday +7 days');
        $end = $this->faker->dateTimeBetween($start, $start->format('Y-m-d') . ' +2 days');

        return [
            'title' => Arr::random(['Test Event', 'Test Event 2', 'Test Event 3']),
            'start' => $start,
            'end' =>  $end,
            'color' => Arr::random(['#3c8dbc', '#00a65a', '#f39c12', '#dd4b39', '#00c0ef', '#3c8dbc', '#00a65a', '#f39c12', '#dd4b39', '#00c0ef']),
        ];
    }
}
