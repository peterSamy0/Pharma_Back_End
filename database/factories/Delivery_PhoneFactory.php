<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Delivery;
use App\Models\Delivery_phone;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Delivery_Phone>
 */
class Delivery_PhoneFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            "phone" => $this->faker->numberBetween(),
            "delivery_id"=>\App\Models\Delivery::inRandomOrder()->first()->id,
        ];
    }
}
