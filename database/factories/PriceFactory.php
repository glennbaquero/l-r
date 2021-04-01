<?php

namespace Database\Factories;

use App\Models\Price;
use Illuminate\Database\Eloquent\Factories\Factory;

class PriceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Price::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'departure_id' => $this->faker->numberBetween(1, 4),
            'arrival_id' => $this->faker->numberBetween(1, 4),
            'currency_id' => 1,
            'arrival_price' => $this->faker->numberBetween(1, 1000),
            'departure_price' => $this->faker->numberBetween(1, 1000),
            'round_trip_price' => $this->faker->numberBetween(1, 1000),
            'minimum_price' => $this->faker->numberBetween(1, 1000),
            'maximum_price' => $this->faker->numberBetween(1, 1000),
        ];
    }
}
