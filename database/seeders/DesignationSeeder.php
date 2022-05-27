<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DesignationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $designations = [
            [
                'team_id' => 1,
                'name' => 'UI Designer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 1,
                'name' => 'UX Designer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 2,
                'name' => 'Vue.js Developer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 2,
                'name' => 'React.js Developer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 3,
                'name' => 'Laravel Developer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 3,
                'name' => 'Nodejs Developer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 4,
                'name' => 'React Native Developer',
                'slug' => 'frontend',
            ],
            [
                'team_id' => 4,
                'name' => 'Flutter Developer',
                'slug' => 'frontend',
            ],
        ];

        foreach ($designations as $designation) {
            \App\Models\Designation::create($designation);
        }
    }
}
