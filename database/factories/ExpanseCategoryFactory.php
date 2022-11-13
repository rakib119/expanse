<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ExpanseCategory>
 */
class ExpanseCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'e_cat_name' => fake()->text('5'),
            'company_id' =>2,
            'created_by' =>2,
            'created_at'=>now(),
        ];
    }
}
