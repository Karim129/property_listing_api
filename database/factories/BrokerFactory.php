<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\odel=Broker>
 */
class BrokerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->company(),
            'address'=> fake()->address(),
            'city'=> fake()->city(),
            'zip_code'=> fake()->postcode(),
            'phone_number'=> fake()->phoneNumber(),
            'logo_path'=> fake()->imageUrl(),
        ];
    }
}