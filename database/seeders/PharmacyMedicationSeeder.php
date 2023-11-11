<?php

namespace Database\Seeders;
use App\Models\PharmacyMedication;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacyMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PharmacyMedication::factory()->count(50)->create();
    }
}
