<?php

namespace Database\Seeders;
use App\Models\ClientPhone;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;


class ClientPhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        ClientPhone::factory()->count(20)->create();
    }
}
