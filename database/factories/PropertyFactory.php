<?php

namespace Database\Factories;

use App\Models\Broker;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'broker_id' => Broker::pluck('id')->random(),
            'listing_type' => $this->faker->randomElement(['Open Listing', 'Sell Listing', 'Exclusive Agency Listing', 'Net Listing']),
            'city' => $this->faker->city(),
            'zip_code' => $this->faker->postcode(),
            'description' => $this->faker->sentence(),
            'address' => $this->faker->streetAddress(),
            'build_year' => $this->faker->year(),
        ];
    }
}
