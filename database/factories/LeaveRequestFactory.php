<?php

namespace Database\Factories;

use App\Models\Company;
use App\Models\Employee;
use App\Models\LeaveType;
use Illuminate\Database\Eloquent\Factories\Factory;

class LeaveRequestFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // $table->foreignIdFor(Company::class)->constrained()->cascadeOnDelete();
        // $table->foreignIdFor(Employee::class)->constrained()->cascadeOnDelete();
        // $table->foreignIdFor(LeaveType::class)->constrained()->cascadeOnDelete();
        // $table->date('start');
        // $table->date('end');
        // $table->text('reason');
        // $table->boolean('status');
        return [
            'company_id' => Company::inRandomOrder()->value('id'),
            'employee_id' => Employee::inRandomOrder()->value('id'),
            'leave_type_id' => LeaveType::inRandomOrder()->value('id'),
            'start' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'end' => $this->faker->dateTimeBetween('-1 year', '+1 year'),
            'reason' => $this->faker->sentence,
            'status' => $this->faker->boolean,
        ];
    }
}
