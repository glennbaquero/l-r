<?php

namespace App\Imports;

use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;


use App\Models\Price;
use App\Models\City;
use App\Models\Currency;

use Log;

class PriceImport implements ToModel, WithHeadingRow
{

    public $destination_zone = [];

    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $price = Price::first();

        if(!$row['departure_zone'] && $row['destination_city']) {
            $destination = City::where('name', $row['destination_city'])->first();

            if(!$destination) {
                $destination = City::create([
                    'name' => $row['destination_city'],
                    'destination_zone' => $row['destination_zone'],
                    'longitude' => '118.2250725',
                    'latitude' => '33.9816812',
                ]);
            } else {
                $destination->update([
                    'destination_zone' => $row['destination_zone'],
                ]);
            }
        }

        if($row['departure_zone'] && $row['adult_ow'] && $row['adult_rt'] && $row['senior_ow'] && $row['senior_rt'] && $row['child_ow'] && $row['child_rt']) {

            $cities_with_same_departure_zone = City::where('destination_zone', $row['departure_zone'])->get();

            $destination = City::where('name', $row['destination_city'])->first();
            
            $destination = $destination ?? City::create([
                    'name' => $row['destination_city'],
                    'destination_zone' => $row['destination_zone'],
                    'longitude' => '118.2250725',
                    'latitude' => '33.9816812',
                ]);
            
            foreach($cities_with_same_departure_zone as $departure) {
                $price = Price::create([
                    'departure_id' => $departure->id,
                    'arrival_id' => $destination->id,
                    'adult_one_way' => $row['adult_ow'],
                    'adult_roundtrip' => $row['adult_rt'],
                    'senior_one_way' => $row['senior_ow'],
                    'senior_roundtrip' => $row['senior_rt'],
                    'child_one_way' => $row['child_ow'],
                    'child_roundtrip' => $row['child_rt'],
                    
                    'currency_id' => Currency::where('symbol', '$')->first() ? Currency::where('symbol', '$')->first()->id : Currency::first()->id,
                ]);
            }
        }

        // $arrival = City::firstOrCreate(['name' => $row['arrival']]);
        // $currency = Currency::firstOrCreate(['name' => $row['currency']]);

        // $price = Price::create([
        // 	'departure_id' => $departure->id,
        // 	'arrival_id' => $arrival->id,
        // 	'currency_id' => $currency->id,
        // 	'currency_id' => $currency->id,
        // 	'arrival_price' => $row['arrival_price'],
        // 	'departure_price' => $row['departure_price'],
        // 	'round_trip_price' => $row['round_trip_price'],
        // ]);

        // dd($this->destination_zone);
        return $price;
    }
}
