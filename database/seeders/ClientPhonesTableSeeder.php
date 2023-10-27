<?php

namespace Database\Seeders;
use App\Models\Client_Phone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ClientPhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client_Phone::factory()->count(20)->create();
    }
}
