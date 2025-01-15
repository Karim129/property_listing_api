<?php

namespace Database\Factories;

use App\Models\Property;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\PropertyCharacteristic>
 */
class PropertyCharacteristicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'property_id' => $this->faker->randomElement(Property::get('id')),
            'price' => $this->faker->randomFloat(2, 0, 0),
            'bedrooms' => $this->faker->numberBetween(2, 0),
            'bathrooms' => $this->faker->numberBetween(2, 0),
            'sqft' => $this->faker->randomFloat(2, 10, 0),
            'price_sqft' => $this->faker->randomFloat(2, 0),
            'property_type' => $this->faker->randomElement(['Single-family Home', 'Townhouse', 'Multi-family Home', 'Bungalow']),
            'status' => $this->faker->randomElement(['Sold', 'On Sale', 'On Hold']),
        ];
    }
}
