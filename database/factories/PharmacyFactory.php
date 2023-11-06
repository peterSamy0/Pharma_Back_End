<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pharmacies>
 */
class PharmacyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $pharamcyUser = User::where('role', 'pharmacy')->inRandomOrder()->first();
        return [
            'user_id' => $pharamcyUser->id,
            'image' => fake()->image(),
            'licence_number' => fake()->unique()->randomNumber(5),
            'bank_account' => fake()->randomNumber(5),
            'governorate_id' => Governorate::inRandomOrder()->first('id'),
            'city_id' => City::inRandomOrder()->first('id'),
            'street' => fake()->streetAddress(),
            'opening' => fake()->time(),
            'closing' => fake()->time(),
        ];
    }
}

    
  

