<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class RouteCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Name', 'Alias', 'Departure', 'Arrival', 'Trip Length', 'Wait Time', 'Distance', 'State', 'Options'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'name', 'alias', 'departure', 'arrival'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($route) {
            return [
                'id' => $route->id,
                'name' => $route->name,
                'alias' => $route->alias,
                'departure' => $route->departure->name,
                'arrival' => $route->stops()->latest()->orderby('id', 'desc')->first()->arrival->name,
                'trip_length' => $route->trip_length,
                'wait_time' => $route->wait_time,
                'distance' => $route->distance,
                'state' => 'New',
                'showUrl' => route('route.show', $route->id),
                'deleteUrl' => route('route.destroy', $route->id),
            ];
        });
    }
}
