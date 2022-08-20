<?php

namespace Database\Seeders;

use Database\Seeders\CmsSeeder;
use Database\Seeders\FaqSeeder;
use Illuminate\Database\Seeder;
use Database\Seeders\PlanSeeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\FeatureSeeder;
use Database\Seeders\CalendarSeeder;
use Database\Seeders\TestimonialSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // For Packaging
        $this->packagingVersion();

        // For Development
        // $this->developmentVersion();
    }

    private function packagingVersion()
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

    private function developmentVersion()
    {
        $this->call([
            PlanSeeder::class,
            AdminSeeder::class,
            ThemeSeeder::class,
            CountrySeeder::class,
            CompanySeeder::class,
            LeaveTypeSeeder::class,
            TeamSeeder::class,
            EmployeeSeeder::class,
            CalendarSeeder::class,
            LeaveRequestSeeder::class,
            HolidayRequestSeeder::class,
            PostSeeder::class,
            FaqSeeder::class,
            FeatureSeeder::class,
            TestimonialSeeder::class,
            LanguageSeeder::class,
            CurrencySeeder::class,
            OrderSeeder::class,
            SettingSeeder::class,
            ContactMessageSeeder::class,
            SeoSeeder::class,
            CmsSeeder::class,
        ]);
    }
}
