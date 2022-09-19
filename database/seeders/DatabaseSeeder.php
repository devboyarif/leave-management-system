<?php

namespace Database\Seeders;

use Database\Seeders\CmsSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\FeatureSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            MasterSeeder::class,
            ThemeSeeder::class,
            CountrySeeder::class,
            FeatureSeeder::class,
            SettingSeeder::class,
            SeoSeeder::class,
            CmsSeeder::class,
        ]);
    }
}
