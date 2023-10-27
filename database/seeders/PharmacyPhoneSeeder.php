<?php

namespace Database\Seeders;
use App\Models\PharmacyPhone;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PharmacyPhoneSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PharmacyPhone::factory()->count(10)->create();
    }
}
