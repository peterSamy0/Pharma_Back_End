<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Delivery;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
<<<<<<< HEAD
        Delivery::factory()->count(200)->create();
=======
        Delivery::factory()->count(20)->create();
>>>>>>> 0ff701b7de8dbda38189e0c88beefe204c771198

    }
}
