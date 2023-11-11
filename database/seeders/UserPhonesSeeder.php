<?php

namespace Database\Seeders;

use App\Models\UserPhone;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserPhonesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        UserPhone::factory()->count(50)->create();
    }
}
