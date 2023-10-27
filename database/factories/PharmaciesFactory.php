<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacies>
 */
class PharmaciesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name,
            'password' => bcrypt('password'),
            'email' => $this->faker->unique()->safeEmail,
            'image' => $this->faker->image,
            'licence_number' => $this->faker->unique()->randomNumber(3),
            'bank_account' => $this->faker->randomNumber(4),
            'Governorate' => $this->faker->state,
            'city' => $this->faker->city,
            'street' => $this->faker->streetAddress,
            'opening' => $this->faker->time,
            'closing' => $this->faker->time,

        ];
    }
}

    
  

