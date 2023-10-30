<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\PharmacyDayOff;


class PharmacyDayOffSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        PharmacyDayOff::factory()->count(10)->create();
    }
}
