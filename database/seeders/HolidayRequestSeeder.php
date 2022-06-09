<?php

namespace Database\Seeders;

use App\Models\HolidayRequest;
use Illuminate\Database\Seeder;

class HolidayRequestSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        HolidayRequest::factory()->count(10)->create();
    }
}
