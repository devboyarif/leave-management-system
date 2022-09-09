<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Country;
use App\Models\Holiday;
use Illuminate\Database\Seeder;

class CompanySeeder extends Seeder
{
    public function createHoliday($company, $country){
        $holidays = getHolidays($country->code);

        for ($i = 0; $i < count($holidays); $i++) {
            $holiday_data[] = [
                'company_id' => $company->id,
                'title' => $holidays[$i]['title'],
                'start' => $holidays[$i]['start'],
                'end' => $holidays[$i]['end'],
                'days' => diffBetweenDays($holidays[$i]['start'], $holidays[$i]['end']),
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        $holiday_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

        foreach ($holiday_chunks as $country) {
            Holiday::insert($country);
        }
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Owner and Company create
        $bdCountry = Country::where('code', 'bd')->first();
        $johnOwner = User::create([
            'name' => 'Ariful Islam',
            'email' => 'owner@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'is_opening_setup_complete' => 1,
        ]);
        $kodebazar = $johnOwner->companies()->create([
            'country_id' => $bdCountry->id,
            'company_name' => 'Kodebazar',
            'company_email' => 'kodebazar@gmail.com',
            'company_phone' => '123456789',
            'company_website' => 'http://kodebazar.devarif.co',
        ]);
        $templatecookie = $johnOwner->companies()->create([
            'country_id' => $bdCountry->id,
            'company_name' => 'Templatecookie',
            'company_email' => 'templatecookie@gmail.com',
            'company_phone' => '123456789',
            'company_website' => 'http://templatecookie.com',
        ]);
        $johnOwner->update(['current_company_id' => $kodebazar->id]);
        $this->createHoliday($kodebazar, $bdCountry);
        $this->createHoliday($templatecookie, $bdCountry);



        // Owner and Company create
        $inCountry = Country::where('code', 'bd')->first();
        $smithOwner = User::create([
            'name' => 'John Smith',
            'email' => 'owner2@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'is_opening_setup_complete' => 1,
        ]);
        $zakirsoft = $smithOwner->companies()->create([
            'country_id' => $inCountry->id,
            'company_name' => 'Zakirsoft',
            'company_email' => 'zakirsoft@gmail.com',
            'company_phone' => '123456789',
            'company_website' => 'http://zakirsoft.com',
        ]);
        $smithOwner->update(['current_company_id' => $zakirsoft->id]);
        $this->createHoliday($zakirsoft, $inCountry);

        // Owner and Company create
        $banCountry = Country::where('code', 'bd')->first();
        $clarkOwner = User::create([
            'name' => 'Clark',
            'email' => 'owner3@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'is_opening_setup_complete' => 1,
        ]);
        $clarkCorporation = $clarkOwner->companies()->create([
            'country_id' => $banCountry->id,
            'company_name' => 'Clark Corporation',
            'company_email' => 'clarkcorporation@gmail.com',
            'company_phone' => '123456789',
            'company_website' => 'http://clarkcorporation.com',
        ]);
        $clarkOwner->update(['current_company_id' => $clarkCorporation->id]);
        $this->createHoliday($clarkCorporation, $banCountry);






        // // Company
        // $country = Country::where('code', 'bd')->first();
        // $user = User::create([
        //     'name' => 'Kodebazar',
        //     'email' => 'kodebazar@mail.com',
        //     'password' => bcrypt('password'),
        //     'avatar' => 'admin/img/default-user.png'
        // ]);
        // $company = $user->company()->create(['country_id' => $country->id]);
        // $holidays = getHolidays($country->code);

        // for ($i = 0; $i < count($holidays); $i++) {
        //     $holiday_data[] = [
        //         'company_id' => $company->id,
        //         'title' => $holidays[$i]['title'],
        //         'start' => $holidays[$i]['start'],
        //         'end' => $holidays[$i]['end'],
        //         'days' => diffBetweenDays($holidays[$i]['start'], $holidays[$i]['end']),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // $holiday_chunks = array_chunk($holiday_data, ceil(count($holiday_data) / 3));

        // foreach ($holiday_chunks as $country) {
        //     Holiday::insert($country);
        // }

        // // Company 2
        // $country2 = Country::where('code', 'in')->first();
        // $user2 = User::create([
        //     'name' => 'Templatecookie',
        //     'email' => 'templatecookie@mail.com',
        //     'password' => bcrypt('password'),
        //     'avatar' => 'admin/img/default-user.png'
        // ]);
        // $company2 = $user2->company()->create(['country_id' => $country2->id]);
        // $holidays2 = getHolidays('indian');

        // for ($i = 0; $i < count($holidays2); $i++) {
        //     $holiday_data2[] = [
        //         'company_id' => $company2->id,
        //         'title' => $holidays2[$i]['title'],
        //         'start' => $holidays2[$i]['start'],
        //         'end' => $holidays2[$i]['end'],
        //         'days' => diffBetweenDays($holidays2[$i]['start'], $holidays2[$i]['end']),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // $holiday_chunks2 = array_chunk($holiday_data2, ceil(count($holiday_data2) / 3));

        // foreach ($holiday_chunks2 as $country) {
        //     Holiday::insert($country);
        // }

        // // Company 3
        // $country3 = Country::where('code', 'us')->first();
        // $user3 = User::create([
        //     'name' => 'Zakirsoft',
        //     'email' => 'zakirsoft@mail.com',
        //     'password' => bcrypt('password'),
        //     'avatar' => 'admin/img/default-user.png'
        // ]);
        // $company3 = $user3->company()->create(['country_id' => $country3->id]);
        // $holidays3 = getHolidays('usa');

        // for ($i = 0; $i < count($holidays3); $i++) {
        //     $holiday_data3[] = [
        //         'company_id' => $company3->id,
        //         'title' => $holidays3[$i]['title'],
        //         'start' => $holidays3[$i]['start'],
        //         'end' => $holidays3[$i]['end'],
        //         'days' => diffBetweenDays($holidays3[$i]['start'], $holidays3[$i]['end']),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // $holiday_chunks3 = array_chunk($holiday_data3, ceil(count($holiday_data3) / 3));

        // foreach ($holiday_chunks3 as $country) {
        //     Holiday::insert($country);
        // }

        // // Company 4
        // $country4 = Country::where('code', 'us')->first();
        // $user4 = User::create([
        //     'name' => 'Company',
        //     'email' => 'company@mail.com',
        //     'password' => bcrypt('password'),
        //     'avatar' => 'admin/img/default-user.png'
        // ]);
        // $company4 = $user4->company()->create(['country_id' => $country4->id]);
        // $holidays4 = getHolidays('bd');

        // for ($i = 0; $i < count($holidays4); $i++) {
        //     $holiday_data4[] = [
        //         'company_id' => $company4->id,
        //         'title' => $holidays4[$i]['title'],
        //         'start' => $holidays4[$i]['start'],
        //         'end' => $holidays4[$i]['end'],
        //         'days' => diffBetweenDays($holidays4[$i]['start'], $holidays4[$i]['end']),
        //         'created_at' => now(),
        //         'updated_at' => now(),
        //     ];
        // }

        // $holiday_chunks4 = array_chunk($holiday_data4, ceil(count($holiday_data4) / 3));

        // foreach ($holiday_chunks4 as $country) {
        //     Holiday::insert($country);
        // }
    }


}
