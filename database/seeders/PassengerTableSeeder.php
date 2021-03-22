<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Passenger;

class PassengerTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       	Passenger::factory()->count(50)->create();
    }
}
