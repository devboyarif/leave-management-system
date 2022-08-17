<?php

namespace Database\Seeders;

use App\Models\Plan;
use App\Models\User;
use App\Models\Currency;
use App\Models\Language;
use App\Models\LeaveType;
use Illuminate\Database\Seeder;

class MasterSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Plan Create
        $plan = Plan::create(['name' => 'Free','type' => 'free', 'price' => '0', 'status' => true,'interval' => 'lifetime','default' => true]);
        $plan->planFeatures()->create(['is_limited_employee' => 1,'max_employees' => 10, 'max_teams' => 2, 'max_leave_types' => 2,'custom_theme_look' => 0]);

        // Admin Create
        User::create([
            'name' => 'Admin',
            'email' => 'admin@mail.com',
            'password' => bcrypt('password'),
            'avatar' => 'admin/img/default-user.png',
            'role' => 'admin',
        ]);

        // Leave Type Create
        $types = [
            ['name' => 'Casual Leave','color' => '#00D084','balance' => 14],
            ['name' => 'Paid Leave','color' => '#EB144C','balance' => 14],
            ['name' => 'Sick Leave','color' => '#FF9F43','balance' => 7],
        ];
        LeaveType::create($types);

        // Language Create
        Language::create(['name' => 'English', 'code' => 'en','direction' => 'ltr']);

        // Currency Create
        Currency::create(['name' => 'US Dollar','code' => 'USD', 'symbol' => '$','symbol_position' => 'left']);

    }
}
