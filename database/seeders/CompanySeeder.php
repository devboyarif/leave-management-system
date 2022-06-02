<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\Holiday;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Company
        $country = Country::where('code', 'bd')->first();
        $user = User::create([
            'name' => 'Kodebazar',
            'email' => 'kodebazar@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);
        $company = Company::create([
            'user_id' => $user->id,
            'country_id' => $country->id,
        ]);
        $holidays = getHolidays($country->code);

        for ($i = 0; $i < count($holidays); $i++) {
            $holiday_data[] = [
                'company_id' => $company->id,
                'country_id' => $country->id,
                'title' => $holidays[$i]['title'],
                'start' => $holidays[$i]['start'],
                'end' => $holidays[$i]['end'],
            ];
        }

        $holiday_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

        foreach ($holiday_chunks as $country) {
            Holiday::insert($country);
        }

        // Company 2
        $country2 = Country::inRandomOrder()->first();
        $user2 = User::create([
            'name' => 'Templatecookie',
            'email' => 'templatecookie@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);
        $company2 = Company::create([
            'user_id' => $user2->id,
            'country_id' => $country2->id,
        ]);

        $holidays2 = getHolidays($country2->code);

        for ($i = 0; $i < count($holidays2); $i++) {
            $holiday_data2[] = [
                'company_id' => $company2->id,
                'country_id' => $country2->id,
                'title' => $holidays2[$i]['title'],
                'start' => $holidays2[$i]['start'],
                'end' => $holidays2[$i]['end'],
            ];
        }

        $holiday_chunks2 = array_chunk($holiday_data2, ceil(count($holiday_data2) / 3));

        foreach ($holiday_chunks2 as $country) {
            Holiday::insert($country);
        }

        // Company 3
        $country3 = Country::inRandomOrder()->first();
        $user3 = User::create([
            'name' => 'Zakirsoft',
            'email' => 'zakirsoft@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);
        $company3 = Company::create([
            'user_id' => $user3->id,
            'country_id' => $country3->id,
        ]);

        $holidays3 = getHolidays($country3->code);

        for ($i = 0; $i < count($holidays3); $i++) {
            $holiday_data3[] = [
                'company_id' => $company3->id,
                'country_id' => $country3->id,
                'title' => $holidays3[$i]['title'],
                'start' => $holidays3[$i]['start'],
                'end' => $holidays3[$i]['end'],
            ];
        }

        $holiday_chunks3 = array_chunk($holiday_data3, ceil(count($holiday_data3) / 3));

        foreach ($holiday_chunks3 as $country) {
            Holiday::insert($country);
        }
    }
}
