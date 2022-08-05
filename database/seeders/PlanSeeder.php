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
                'status' => true,
                'interval' => 'lifetime',
                'default' => true,
            ],
            [
                'name' => 'Standard',
                'type' => 'paid',
                'price' => 50,
                'status' => true,
                'interval' => 'monthly',
            ],
            [
                'name' => 'Premium',
                'type' => 'paid',
                'price' => 80,
                'status' => true,
                'recommended' => true,
                'interval' => 'yearly',
            ],
            [
                'name' => 'Custom',
                'type' => 'paid',
                'price' => 20,
                'status' => true,
                'interval' => 'custom_days',
                'custom_interval_days' => '15',
            ],
        ];

        foreach ($plans as $plann) {
            $plan = Plan::create($plann);

            if ($plan->type == 'free') {
                $plan->planFeatures()->create([
                    'is_limited_employee' => 1,
                    'max_employees' => 10,
                    'max_teams' => 2,
                    'max_leave_types' => 2,
                    'custom_theme_look' => 0,
                ]);
            } else {
                if ($plan->interval == 'custom_days') {
                    $plan->planFeatures()->create([
                        'is_limited_employee' => 0,
                        'max_employees' => 50,
                        'max_teams' => 10,
                        'max_leave_types' => 10,
                        'custom_theme_look' => 1,
                    ]);
                } else {
                    $plan->planFeatures()->create([
                        'is_limited_employee' => 1,
                        'max_employees' => 50,
                        'max_teams' => 10,
                        'max_leave_types' => 10,
                        'custom_theme_look' => 1,
                    ]);
                }
            }
        }
    }
}
