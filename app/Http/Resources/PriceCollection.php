<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class PriceCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       // 'Departure', 'Arrival', 'Currency', 'Arrival Price', 'Departure Price', 'Round Trip Price', 'Actions'
       'Departure', 'Arrival', 'Currency', 'Arrival Price', 'Departure Price', 'Round Trip Price', 'Adult One Way', 'Adult Round Trip', 'Senior One Way', 'Senior Round Trip', 'Child One Way', 'Child Round Trip', 'Actions'
       // 'Minimum Price', 'Maximum Price',
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        // 'departure', 'arrival', 'currency', 'arrival_price', 'departure_id'
        'departure', 'arrival', 'currency', 'departure_id'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($price) {
            return [
                'departure' => $price->departure->name,
                'arrival' => $price->arrival->name,
                'currency' => $price->currency->name,
                'arrival_price' => number_format($price->arrival_price, 2, '.', ','),
                'departure_price' => number_format($price->departure_price, 2, '.', ','),
                'round_trip_price' => number_format($price->round_trip_price, 2, '.', ','),
                'minimum_price' => $price->minimum_price,
                'maximum_price' => $price->maximum_price,

                'adult_one_way' => number_format($price->adult_one_way, 2, '.', ','),
                'adult_roundtrip' => number_format($price->adult_roundtrip, 2, '.', ','),
                'senior_one_way' => number_format($price->senior_one_way, 2, '.', ','),
                'senior_roundtrip' => number_format($price->senior_roundtrip, 2, '.', ','),
                'child_one_way' => number_format($price->child_one_way, 2, '.', ','),
                'child_roundtrip' => number_format($price->child_roundtrip, 2, '.', ','),

                'deleteUrl' => route('price.destroy', $price->id),
                'showUrl' => route('price.show', $price->id),
            ];
        });
    }
}
