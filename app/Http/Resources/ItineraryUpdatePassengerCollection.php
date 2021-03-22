<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class ItineraryUpdatePassengerCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
      'Series', 'Passenger', 'Seat', 'Arrival City', 'E-mail', 'Cellphone Number', 'State'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
       'trip_id'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($passenger) {
            return [
                'id' => $passenger->id,
                'series' => null,
                'fullname' => $passenger->fullname,
                'email' => $passenger->email,
                'seat' => $passenger->bus_model_column->label,
                'email' => $passenger->email,
                'arrival' => $passenger->arrival->name,
                'cellphone_number' => $passenger->phone_number,
                'state' => $passenger->state,
                // 'deleteUrl' => route('trip.destroy', $trip->id),
            ];
        });
    }
}
