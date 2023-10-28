<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PharmacyDaysOff>
 */
class PharmacyDayOffFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'pharmacy_id' => \App\Models\Pharmacy::inRandomOrder()->first('id'),
            'day_id' => \App\Models\Day::inRandomOrder()->first('id'),
        ];
    }
}
