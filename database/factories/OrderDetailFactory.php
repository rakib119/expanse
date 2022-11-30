<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderDetail>
 */
class OrderDetailFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'order_id' => rand(1,30),
            'product_id' => rand(1,20),
            'unit_price' => rand(500,5000),
            'quantity' => rand(1,5),
            'amount' => rand(10000,50000),
            'created_at' => now(),
        ];
    }
}
