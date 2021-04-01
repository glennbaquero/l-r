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
			array('name' => "Anchorage"),
			array('name' => "Barrow"),
			array('name' => "Bethel"),
			array('name' => "College"),
			array('name' => "Fairbanks"),
			array('name' => "Homer"),
			array('name' => "Juneau"),
			array('name' => "Kenai"),
			array('name' => "Ketchikan"),
			array('name' => "Kodiak"),
			array('name' => "Nome"),
			array('name' => "Palmer"),
			array('name' => "Sitka"),
			array('name' => "Soldotna"),
			array('name' => "Sterling"),
			array('name' => "Unalaska"),
			array('name' => "Valdez"),
			array('name' => "Wasilla"),
			array('name' => "Apache Junction"),
			array('name' => "Avondale"),
			array('name' => "Bisbee"),
			array('name' => "Bouse"),
			array('name' => "Bullhead City"),
			array('name' => "Carefree"),
			array('name' => "Casa Grande"),
			array('name' => "Casas Adobes"),
			array('name' => "Chandler"),
			array('name' => "Clarkdale"),
			array('name' => "Cottonwood"),
			array('name' => "Douglas"),
			array('name' => "Drexel Heights"),
			array('name' => "El Mirage"),
			array('name' => "Flagstaff"),
			array('name' => "Florence"),
			array('name' => "Flowing Wells"),
			array('name' => "Fort Mohave"),
			array('name' => "Fortuna Foothills"),
			array('name' => "Fountain Hills"),
			array('name' => "Gilbert"),
			array('name' => "Glendale"),
			array('name' => "Globe"),
			array('name' => "Goodyear"),
			array('name' => "Green Valley"),
			array('name' => "Kingman"),
			array('name' => "Lake Havasu City"),
			array('name' => "Laveen"),
			array('name' => "Litchfield Park"),
			array('name' => "Marana"),
			array('name' => "Mesa"),
			array('name' => "New Kingman-Butler"),
			array('name' => "Nogales"),
			array('name' => "Oracle"),
			array('name' => "Oro Valley"),
			array('name' => "Paradise Valley"),
			array('name' => "Parker"),
			array('name' => "Payson"),
			array('name' => "Peoria"),
			array('name' => "Phoenix"),
			array('name' => "Pine"),
	    );

	    foreach ($cities as $key => $city) {
	    	City::create($city);
	    }
    }
}
