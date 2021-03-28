<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class TripCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Route', 'Alias', 'Bus', 'Driver', 'Date', 'Departure', 'Arrival', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'route', 'alias', 'bus', 'driver', 'date', 'departure', 'arrival', 'date_range', 'departure_id', 'arrival_id', 'route_id'
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
                'showUrl' => route('trip.show', $trip->id),
                'deleteUrl' => route('trip.destroy', $trip->id),
            ];
        });
    }
}
