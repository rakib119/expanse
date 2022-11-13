<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_amount'=>rand(10000,1000000),
            'company_id' => 2,
            'manager_id' => null,
            'sels_executive_id' => 4,
            'created_by' =>4,
            'customer_id' => rand(1,50),
            'created_at'=>now(),
        ];
    }
}
