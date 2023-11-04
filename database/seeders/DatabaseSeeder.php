<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Category;
use App\Models\Day;
use App\Models\Medication;
use App\Models\Order;
use App\Models\OrderMedication;
use App\Models\Pharmacy;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ClientsTableSeeder::class);
        $this->call(ClientPhonesTableSeeder::class);
        $this->call(DeliverySeeder::class);
        // $this->call(Delivery_PhoneSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(PharmacySeeder::class);
        $this->call(MedicationSeeder::class);
        $this->call(DaySeeder::class);
        $this->call(OrderSeeder::class);
        $this->call(OrderMedicationSeeder::class);


    }
}
