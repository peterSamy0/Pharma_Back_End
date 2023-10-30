<?php

namespace Database\Factories;

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
        return [
            //
            'name'=>$this->faker->name,
            "Governorate"=>$this->faker->city,
            "city"=>$this->faker->city,
            "email"=>$this->faker->SafeEmail,
            "password"=>bcrypt($this->faker->password),
            "national_ID"=>$this->faker->unique()->numberBetween(),
        ];
    }
}
