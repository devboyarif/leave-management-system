<?php

namespace Database\Factories;

use App\Models\Plan;
use App\Models\Company;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'order_id' => uniqid(),
            'transaction_id' => uniqid('tr_'),
            'payment_provider' => $this->faker->randomElement(['flutterwave', 'mollie', 'midtrans', 'paypal', 'paystack', 'razorpay','stripe', 'instamojo']),
            'amount' => rand(100, 1000),
            'currency_symbol' => $this->faker->randomElement(['$', '₦', '₹', '€', '£']),
            'usd_amount' => rand(100, 1000),
            'expired_date' => $this->faker->dateTimeBetween('now', '+1 year'),
            'plan_id' => Plan::inRandomOrder()->value('id'),
            'company_id' => Company::inRandomOrder()->value('id'),
        ];

    }
}
