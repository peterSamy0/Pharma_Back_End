<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\Medication;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\OrderMedication>
 */
class OrderMedicationFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'order_id'=> Order::inRandomOrder()->first()->id ,
            "medicine_id"=> Medication::inRandomOrder()->first()->id,
            "amount" => $this->faker->randomDigit()
        ];
    }
}
