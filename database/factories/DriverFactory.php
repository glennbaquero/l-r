<?php

namespace Database\Factories;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\Factory;

class DriverFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Driver::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'document_no' => $this->faker->randomNumber,
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'gender' => 'Male',
            'phone_number' => $this->faker->phoneNumber,
            'email' => $this->faker->safeEmail,
            'address_line_1' => $this->faker->address,
            'latitude' => $this->faker->latitude,
            'longitude' => $this->faker->longitude,
            'city' => $this->faker->city,
            'license_type' => $this->faker->word,
            'license_no' => $this->faker->randomNumber,
            'license_expiration_date' => $this->faker->date,
            'last_medical_test_date' => $this->faker->date,
            'next_medical_test_date' => $this->faker->date,
        ];
    }
}
