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
                'company_id' => 1,
                'name' => 'UI/UX',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 1,
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 1,
                'name' => 'Backend',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 1,
                'name' => 'Mobile',
                'slug' => 'frontend',
            ]
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
