<?php

namespace Database\Seeders;

use Carbon\Carbon;
use App\Models\Country;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $countries_list = json_decode(file_get_contents(base_path('resources/json/country.json')), true);

        for ($i = 0; $i < count($countries_list); $i++) {
            $country_data[] = [
                'name' => $countries_list[$i]['name'],
                'slug' => Str::slug($countries_list[$i]['name']),
                'icon' => 'flag-icon-' . Str::lower($countries_list[$i]['sortname']),
                'code' => strtolower($countries_list[$i]['sortname']),
            ];
        }

        $country_chunks = array_chunk($country_data, ceil(count($country_data) / 3));

        foreach ($country_chunks as $country) {
            Country::insert($country);
        }
    }
}
