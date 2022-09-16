<?php

namespace Database\Seeders;

use App\Models\TeamSize;
use Illuminate\Database\Seeder;

class TeamSizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $team_sizes = [
            '1-5','6-10','11-20','21-50','50-100','101-200','200+'
        ];

        foreach ($team_sizes as $size) {
            TeamSize::create(['name' => $size]);
        }
    }
}
