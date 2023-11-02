<?php

namespace Database\Factories;
use App\Models\Client;
use App\Models\Pharmacy;
use App\Models\Delivery;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'client_id' => Client::inRandomOrder()->first()->id ,
            "pharmacy_id" => Pharmacy::inRandomOrder()->first()->id,
            "delivery_id" => Delivery::inRandomOrder()->first()->id,
            "status"=> $this->faker->randomElement(['pending','accepted','withDelivery','delivered'])
        ];
    }
}
