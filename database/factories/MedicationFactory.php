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
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text(1000),
            'category_id' => \App\Models\Category::factory(),
        ];
    }
}
