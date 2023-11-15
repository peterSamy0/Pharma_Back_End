<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PharmacyMedications>
 */
class PharmacyMedicationFactory extends Factory
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
            'medication_id' => \App\Models\Medication::inRandomOrder()->first('id'),
        ];
    }
}
