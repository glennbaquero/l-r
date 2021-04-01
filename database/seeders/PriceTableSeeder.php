<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Price;
use App\Models\Currency;

class PriceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Currency::create([
        	'name' => 'Dollar',
        	'equivalent_in_dollars_principle_tills' => 100,
        	'equivalent_in_dollars_additional_tills' => 100,
        	'symbol' => '$',
        	'default_currency' => true,
        	'country' => 'United States',
        ]);

        Price::factory()->count(10)->create();
    }
}
