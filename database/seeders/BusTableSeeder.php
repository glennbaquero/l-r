<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Bus;

class BusTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $buses = [
        	[
        		'name' => 'Bus 1',
                'plate' => 'Bus 1',
                'bus_model_id' => 1,
        	],
        	[
        		'name' => 'Bus 2',
                'plate' => 'Bus 2',
                'bus_model_id' => 1,
        	],
        	[
        		'name' => 'Bus 3',
                'plate' => 'Bus 3',
                'bus_model_id' => 1,
        	],
        ];


        foreach ($buses as $bus) {
        	Bus::create($bus);
        }
    }
}
