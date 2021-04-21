<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class DailyItineraryCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Trip Route', 'Departure Time', 'Price One-Way', 'Price Of Return', 'Service', 'Available', 'Seats Reserved', 'Sold'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        //
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($trip) {
            return [
                'id' => $trip->id,
                'route' => $trip->route->name,
                'route_id' => $trip->route->id,
                'time' => Carbon::parse($trip->time)->format('h:m A'),
                'departure_price' => number_format($trip->route->departure->departure_prices()->first()->departure_price, 2, '.', ','),
                'arrival_price' => number_format($trip->route->stops()->latest()->orderby('id', 'desc')->first()->arrival->arrival_prices()->first()->arrival_price, 2, '.', ','),
                'service' => $trip->service->name,
                'available' => $trip->getAvailableSeat(),
                'seat_reserved' => $trip->tickets()->where('payment_status', 'Reserved')->count(),
                'sold' => $trip->tickets()->where('payment_status', 'Paid')->count(),
            ];
        });
    }
}
