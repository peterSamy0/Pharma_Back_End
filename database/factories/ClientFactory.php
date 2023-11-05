<?php

namespace Database\Factories;

use App\Models\City;
use App\Models\Governorate;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $clientUser = User::where('role', 'client')->inRandomOrder()->first();
        return [
            'user_id' => $clientUser->id,
            'governorate_id' => Governorate::inRandomOrder()->first('id'),
            'city_id' => City::inRandomOrder()->first('id'),
        ];
    }
}
