<?php

namespace Database\Seeders;

use App\Models\Client_Phone;
use Illuminate\Database\Seeder;

class ClientPhonesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Client_Phone::factory()->count(40)->create();
    }
}
