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
        		'name' => 'Bus 1'
        	],
        	[
        		'name' => 'Bus 2'
        	],
        	[
        		'name' => 'Bus 3'
        	],
        ];


        foreach ($buses as $bus) {
        	Bus::create($bus);
        }
    }
}
