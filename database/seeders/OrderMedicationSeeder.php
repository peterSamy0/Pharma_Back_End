<?php

namespace Database\Seeders;

use App\Models\OrderMedication;


use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderMedicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        OrderMedication::factory()->count(100)->create();
    }
}
