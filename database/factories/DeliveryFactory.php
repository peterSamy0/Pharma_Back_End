<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery>
 */
class DeliveryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $deliveryUser = User::where('role', 'delivery')->inRandomOrder()->first();
        return [
            'user_id' => $deliveryUser->id,
            'governorate_id' => Governorate::inRandomOrder()->first('id'),
            'city_id' => City::inRandomOrder()->first('id'),
            "national_ID"=>fake()->unique()->randomNumber(5),
            "available" => fake()->boolean(),
            'admin_approval' => $this->faker->randomElement(['pending', 'rejected', 'approved']), // Default value
        ];
    }
}
