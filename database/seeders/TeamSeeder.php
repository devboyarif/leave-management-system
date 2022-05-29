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
                'slug' => 'ui-ux',
            ],
            [
                'company_id' => 1,
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 1,
                'name' => 'Backend',
                'slug' => 'backend',
            ],
            [
                'company_id' => 1,
                'name' => 'Mobile',
                'slug' => 'mobile',
            ],
            [
                'company_id' => 2,
                'name' => 'UI/UX',
                'slug' => 'ui-ux',
            ],
            [
                'company_id' => 2,
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 2,
                'name' => 'Backend',
                'slug' => 'backend',
            ],
            [
                'company_id' => 2,
                'name' => 'Mobile',
                'slug' => 'mobile',
            ],
            [
                'company_id' => 3,
                'name' => 'UI/UX',
                'slug' => 'ui-ux',
            ],
            [
                'company_id' => 3,
                'name' => 'Frontend',
                'slug' => 'frontend',
            ],
            [
                'company_id' => 3,
                'name' => 'Backend',
                'slug' => 'backend',
            ],
            [
                'company_id' => 3,
                'name' => 'Mobile',
                'slug' => 'mobile',
            ],
        ];

        foreach ($teams as $team) {
            Team::create($team);
        }
    }
}
