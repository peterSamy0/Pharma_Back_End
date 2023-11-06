<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
 use Database\Factories\Category;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Medication>
 */
class MedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->name(),
            'price' => fake()->randomNumber(2),
            'image' =>fake()->image(),  
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ];
    }
}
