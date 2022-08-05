<?php

namespace Database\Seeders;

use App\Models\LeaveType;
use App\Models\User;
use Illuminate\Database\Seeder;

class LeaveTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
            [
                'name' => 'Casual Leave',
                'color' => '#00D084',
                'balance' => 14,
            ],
            [
                'name' => 'Paid Leave',
                'color' => '#EB144C',
                'balance' => 14,
            ],
            [
                'name' => 'Sick Leave',
                'color' => '#FF9F43',
                'balance' => 7,
            ],
        ];

        foreach ($types as $type) {
            $type['company_id'] = 1;
            LeaveType::create($type);
        }

        foreach ($types as $type) {
            $type['company_id'] = 2;
            LeaveType::create($type);
        }

        foreach ($types as $type) {
            $type['company_id'] = 3;
            LeaveType::create($type);
        }

        foreach ($types as $type) {
            $type['company_id'] = 4;
            LeaveType::create($type);
        }
    }
}
