<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'admin',
            // 'current_company_id' => ''
        ]);

        User::create([
            'name' => 'Developer',
            'email' => 'developer@mail.com',
            'password' => bcrypt('password@12345'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'admin',
            // 'current_company_id' => ''
        ]);
    }
}
