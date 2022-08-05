<?php

namespace Database\Seeders;

use App\Models\Theme;
use Illuminate\Database\Seeder;

class ThemeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Theme::create([
            'primary_color' => '#0984e3',
            'secondary_color' => '#596275',
            'success_color' => '#2ecc71',
            'danger_color' => '#eb4d4b',
            'info_color' => '#00d9ff',
            'warning_color' => '#eab308',
        ]);
    }
}
