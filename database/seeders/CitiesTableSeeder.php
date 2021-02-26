<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\City;

class CitiesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $cities = array(
	        array('name' => 'Albany'),
	        array('name' => 'Anaheim'),
	        array('name' => 'Anderson'),
	        array('name' => 'Ashland'),
	        array('name' => 'Atwater'),
	        array('name' => 'Bakersfield'),
	        array('name' => 'Bell'),
	        array('name' => 'Bend'),
	    );

	    foreach ($cities as $key => $city) {
	    	City::create($city);
	    }
    }
}
