<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Expanse>
 */
class ExpanseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'cat_id' => rand(1,10),
            'remarks' => fake()->text(50),
            'amount'=>rand(10000,100000),
            'company_id' => 2,
            'company_id' => 2,
            'created_at'=>now(),
        ];
    }
}
