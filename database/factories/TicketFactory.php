<?php

namespace Database\Factories;

use App\Models\Ticket;
use Illuminate\Database\Eloquent\Factories\Factory;

class TicketFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Ticket::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'passenger_id' => $this->faker->numberBetween(1, 15),
            'seller_id' => 1,
            'departure_id' => $this->faker->unique(true)->numberBetween(1, 15),
            'arrival_id' => $this->faker->unique(true)->numberBetween(1, 15),
            'purchase_date' => now(),
            'trip_id' => $this->faker->numberBetween(1, 3),
            'bus_model_column_id' => $this->faker->numberBetween(1, 15),
            'purchase_date' => now(),
            'trip_id' => $this->faker->numberBetween(1, 3),
        ];
    }
}
