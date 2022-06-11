<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\AdminSeeder;
use Database\Seeders\CountrySeeder;
use Database\Seeders\CalendarSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        $this->call([
            AdminSeeder::class,
            CountrySeeder::class,
            CompanySeeder::class,
            LeaveTypeSeeder::class,
            TeamSeeder::class,
            EmployeeSeeder::class,
            CalendarSeeder::class,
            LeaveRequestSeeder::class,
            HolidayRequestSeeder::class,
            PostSeeder::class
        ]);
    }
}
