<?php

namespace Database\Factories;

use App\Models\Passenger;
use Illuminate\Database\Eloquent\Factories\Factory;

class PassengerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Passenger::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'trip_id' => $this->faker->numberBetween(1, 3),
            'bus_model_column_id' => $this->faker->numberBetween(1, 5),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'middle_name' => $this->faker->lastName,
            'arrival_city_id' => $this->faker->unique(true)->numberBetween(1, 3),
            'email' => $this->faker->email,
            'phone_number' => $this->faker->phoneNumber,
            'state' => 'Sold Out',
        ];
    }
}
