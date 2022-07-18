<?php

namespace Database\Seeders;

use App\Models\Plan;
use Illuminate\Database\Seeder;

class PlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $plans = [
            [
                'name' => 'Free',
                'type' => 'free',
                'price' => '0',
                'order' => 1,
                'status' => true,
                'interval' => 'lifetime',
            ],
            [
                'name' => 'Standard',
                'type' => 'paid',
                'price' => '1',
                'order' => 2,
                'status' => true,
                'interval' => 'monthly',
            ],
            [
                'name' => 'Premium',
                'type' => 'paid',
                'price' => '1',
                'order' => 3,
                'status' => true,
                'interval' => 'yearly',
            ],
            [
                'name' => 'Custom',
                'type' => 'paid',
                'price' => '1',
                'order' => 4,
                'status' => true,
                'interval' => 'custom_date',
                'custom_interval_days' => '15',
            ],
        ];

        foreach ($plans as $plann) {
            $plan = Plan::create($plann);

            if ($plan->type == 'free') {
                $plan->planFeatures()->create([
                    'is_limited_user' => 1,
                    'max_employees' => 10,
                    'max_teams' => 2,
                    'dark_mode' => 0,
                    'custom_theme_look' => 0,
                ]);
            } else {
                $plan->planFeatures()->create([
                    'is_limited_user' => 0,
                    'max_employees' => 10,
                    'max_teams' => 10,
                    'dark_mode' => 1,
                    'custom_theme_look' => 1,
                ]);
            }
        }
    }
}
