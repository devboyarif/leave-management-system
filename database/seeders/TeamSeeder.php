<?php

namespace Database\Seeders;

use App\Models\Team;
use Illuminate\Database\Seeder;

class TeamSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $teams = [
            [
                'name' => 'UI/UX',
                'slug' => 'frontend',
            ],
            [
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'name' => 'Backend',
                'slug' => 'frontend',
            ],
            [
                'name' => 'Mobile',
                'slug' => 'frontend',
            ]
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
