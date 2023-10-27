<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client_Phone>
 */
class Client_PhoneFactory extends Factory
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
            'clinet_id' => \App\Models\Client::inRandomOrder()->first('id'),
        ];
    }
}
