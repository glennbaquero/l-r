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
       'Departure', 'Arrival', 'Currency', 'Arrival Price', 'Departure Price', 'Round Trip Price', 'Actions'
       // 'Minimum Price', 'Maximum Price',
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'departure', 'arrival', 'currency', 'arrival_price'
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
                'arrival_price' => $price->arrival_price,
                'departure_price' => $price->departure_price,
                'round_trip_price' => $price->round_trip_price,
                'minimum_price' => $price->minimum_price,
                'maximum_price' => $price->maximum_price,
                'deleteUrl' => route('price.destroy', $price->id),
                'showUrl' => route('price.show', $price->id),
            ];
        });
    }
}
