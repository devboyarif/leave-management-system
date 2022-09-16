<?php

namespace Database\Seeders;

use App\Models\Language;
use Illuminate\Database\Seeder;

class LanguageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Language::create([
            'name' => 'English',
            'code' => 'en',
        ]);

        Language::create([
            'name' => 'Bangla',
            'code' => 'bn',
        ]);
    }
}
