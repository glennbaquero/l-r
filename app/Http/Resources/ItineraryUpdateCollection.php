<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class ItineraryUpdateCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
      'Route', 'Alias', 'Bus', 'Driver', 'Date', 'Departure', 'Arrival', 'Service', 'Arrival Price', 'Departure Price', 'Sold', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
       'route', 'date', 'departure', 'arrival', 'date_range', 'departure_id', 'arrival_id', 'route_id'
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
            $date = Carbon::parse($trip->date.' '.$trip->time)->format('m-d-Y h:i A');
            return [
                'id' => $trip->id,
                'route' => $trip->route->name,
                'alias' => $trip->route->alias,
                'bus' => $trip->bus->name,
                'driver' => $trip->driver->fullname,
                'date' => $date,
                'departure' => $trip->route->departure->name,
                'arrival' => $trip->route->stops()->latest()->orderby('id', 'desc')->first()->arrival->name,

                'departure_price' => number_format($trip->route->departure->departure_prices()->first()->departure_price, 2, '.', ','),
                'arrival_price' => number_format($trip->route->stops()->latest()->orderby('id', 'desc')->first()->arrival->arrival_prices()->first()->arrival_price, 2, '.', ','),
                'service' => $trip->service->name,
                'sold' => 0,
                'fetchPassengerUrl' => route('itinerary-passenger.fetch', $trip->id),
                'fetchObservationUrl' => route('itinerary-observation.fetch', $trip->id),
                // 'deleteUrl' => route('trip.destroy', $trip->id),
            ];
        });
    }
}
