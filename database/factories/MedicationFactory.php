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
    // public function definition(): array
    // {
    //     return [
    //         'name' => fake()->name(),
    //         'price' => fake()->randomNumber(2),
    //         'description'=> $this->faker->paragraph(5),
    //         'image' =>fake()->image(),  
    //         'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
    //     ];
    // }

    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'image' => $this->faker->imageUrl(),
            'description' => $this->faker->text(1000),
            'category_id' => \App\Models\Category::inRandomOrder()->first()->id,
        ];
    }
}
