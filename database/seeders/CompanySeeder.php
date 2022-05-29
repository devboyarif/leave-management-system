<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Company;
use App\Models\Country;
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
        $user = User::create([
            'name' => 'Kodebazar',
            'email' => 'kodebazar@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);

        Company::create([
            'user_id' => $user->id,
            'country_id' => Country::inRandomOrder()->value('id'),
        ]);

        $user2 = User::create([
            'name' => 'Templatecookie',
            'email' => 'templatecookie@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);

        Company::create([
            'user_id' => $user2->id,
            'country_id' => Country::inRandomOrder()->value('id'),
        ]);

        $user3 = User::create([
            'name' => 'Zakirsoft',
            'email' => 'zakirsoft@mail.com',
            'password' => bcrypt('password'),
            'avatar' => asset('admin/img/default-user.png')
        ]);

        Company::create([
            'user_id' => $user3->id,
            'country_id' => Country::inRandomOrder()->value('id'),
        ]);
    }
}
