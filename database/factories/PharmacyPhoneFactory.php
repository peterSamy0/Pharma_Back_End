<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PharmacyPhone>
 */
class PharmacyPhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            
             "phone" => $this->faker->randomNumber(9),
            'pharmacy_id' => \App\Models\Pharmacy::inRandomOrder()->first('id'),
        ];
    }
}
