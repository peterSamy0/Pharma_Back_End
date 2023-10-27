<?php

namespace Database\Seeders;
use App\Models\Pharmacies;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmaciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Pharmacies::factory()->count(2)->create();
    }
}
