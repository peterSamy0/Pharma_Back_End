<?php

namespace Database\Seeders;
use App\Models\Medication;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $jsonFilePath = public_path('images/medications.json');
        $json = file_get_contents($jsonFilePath);
        $medications = json_decode($json, true);
        foreach ($medications as $medication) {
            Medication::create($medication);
        }
        // Medication::factory()->count(200)->create();
    }
}
