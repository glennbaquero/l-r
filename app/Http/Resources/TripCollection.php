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

    public static $headers_report = [
       'Departure Date', 'Route', 'Bus', 'Services', 'Departure', 'Arrival', 'Driver', 'Total', 'Free', 'Sold', 'Boarded', 'Reserved', 'Actions'
    ];

    public static $passenger_reports_header = [
       'Passenger', 'Seat'
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

                // Report 
                
                'departure_date' => $trip->formatted_date. ' '. $trip->formatted_time,
                'route' => $trip->route->name,
                'route_id' => $trip->route->id,
                'bus' => $trip->bus->name,
                'service' => $trip->service->name,
                'departure' => $trip->route->departure->name,
                'arrival' => $trip->route->stops()->latest()->orderby('id', 'desc')->first()->arrival->name,
                'driver' => $trip->driver->fullname,
                'total' => $trip->bus->getTotalSeat(),
                'free' => $trip->bus->getTotalSeat() - $trip->tickets()->count(),
                'sold' => $trip->tickets()->where('payment_status', 'Paid')->get()->count(),
                'boarded' => $trip->tickets()->where('boarding_status', 'Boarded')->get()->count(),
                'reserved' => $trip->tickets()->where('payment_status', 'Reserved')->where('boarding_status', 'Not Boarding Yet')->get()->count(),
                'fetchTotalPassengerUrl' => route('total-passenger.fetch', [$trip->id, 'total']),
                'fetchSoldPassengerUrl' => route('total-passenger.fetch', [$trip->id, 'sold']),
                'fetchReservedPassengerUrl' => route('total-passenger.fetch', [$trip->id, 'reserved']),
                'fetchBoardedPassengerUrl' => route('total-passenger.fetch', [$trip->id, 'boarded']),
            ];
        });
    }
}
