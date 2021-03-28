<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class TravelExpenseCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Route', 'Alias', 'Bus', 'Driver', 'Date', 'Departure', 'Arrival', 'Expenses Number', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'departure', 'arrival', 'date_range', 'route_id', 'date', 'departure_id', 'arrival_id'
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
                'route' => $trip->route->name,
                'alias' => $trip->route->alias,
                'bus' => $trip->bus->name,
                'driver' => $trip->driver->fullname,
                'date' => $date,
                'expense_count' => $trip->expenses()->count(),
                'departure' => $trip->route->departure->name,
                'arrival' => $trip->route->stops()->latest()->orderby('id', 'desc')->first()->arrival->name,
                'createUrl' => route('travel-expense.create', $trip->id),
                'showUrl' => route('travel-expense.show', $trip->id),
                // 'deleteUrl' => route('route.destroy', $trip->id),
            ];
        });
    }
}
