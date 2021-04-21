<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use App\Models\Price;
use App\Models\City;
use App\Models\Currency;

class PriceImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $departure = City::firstOrCreate(['name' => $row['departure']]);
        $arrival = City::firstOrCreate(['name' => $row['arrival']]);
        $currency = Currency::firstOrCreate(['name' => $row['currency']]);

        $price = Price::create([
        	'departure_id' => $departure->id,
        	'arrival_id' => $arrival->id,
        	'currency_id' => $currency->id,
        	'currency_id' => $currency->id,
        	'price_per_mile' => $row['price_per_mile'],
        	'arrival_price' => $row['arrival_price'],
        	'departure_price' => $row['departure_price'],
        	'round_trip_price' => $row['round_trip_price'],
        	'minimum_price' => $row['minimum_price'],
        	'maximum_price' => $row['maximum_price'],
        ]);

        return $price;
    }
}
