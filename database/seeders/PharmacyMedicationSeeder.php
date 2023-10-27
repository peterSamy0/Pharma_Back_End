<?php

namespace Database\Seeders;
use App\Models\PharmacyMedications;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacyMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PharmacyMedications::factory()->count(10)->create();
    }
}
