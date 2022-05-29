<?php

namespace Database\Factories;

use App\Models\Company;
use Illuminate\Support\Arr;
use Illuminate\Database\Eloquent\Factories\Factory;

class TeamFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $team_name = Arr::random([
            'UI/UX',
            'Frontend',
            'Backend',
            'Mobile'
        ]);

        return [
            'company_id' => Company::inRandomOrder()->value('id'),
            'name' => $team_name,
            'slug' => strSlug($team_name),
        ];
    }
}
