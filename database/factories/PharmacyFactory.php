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
    // public function definition(): array
    // {
    //     $pharamcyUser = User::where('role', 'pharmacy')->inRandomOrder()->first();
    //     $governorate = Governorate::inRandomOrder()->first();
    //     $city = City::where('governorate_id', $governorate->id)->inRandomOrder()->first();
    //     return [
    //         'user_id' => $pharamcyUser->id,
    //         'image' => fake()->image(),
    //         'licence_number' => fake()->unique()->randomNumber(5),
    //         'bank_account' => fake()->randomNumber(5),
    //         'governorate_id' => $governorate->id,
    //         'city_id' => $city->id,
    //         'street' => fake()->streetAddress(),
    //         'opening' => fake()->time(),
    //         'closing' => fake()->time(),
    //     ];
    // }

    public function definition()
    {
        $pharmacyUser = User::where('role', 'pharmacy')->inRandomOrder()->first();
        $governorate = Governorate::inRandomOrder()->first();
        $city = City::where('governorate_id', $governorate->id)->inRandomOrder()->first();
    
        if (!$pharmacyUser || !$governorate || !$city) {
            return []; // Return an empty array if any of the variables are null
        }
    
        return [
            'user_id' => $pharmacyUser->id,
            'licence_number' => $this->faker->unique()->numerify('PH-######'),
            'bank_account' => $this->faker->unique()->bankAccountNumber,
            'governorate_id' => $governorate->id,
            'city_id' => $city->id,
            'street' => $this->faker->streetAddress,
            'opening' => $this->faker->time('H:i:s', '08:00:00'),
            'closing' => $this->faker->time('H:i:s', '20:00:00'),
            'admin_approval' => $this->faker->randomElement(['pending', 'rejected', 'approved']), // Default value
        ];
    }

}

    
  

