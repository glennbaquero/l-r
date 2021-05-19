<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class MostUsedCouponCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Code', 'Ticket ID', 'Passenger', 'Trip Date', 'Departure', 'Arrival'
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
        return $this->collection->map(function($ticket) {
            return [
                'code' => $ticket->voucher_code,
                'id' => $ticket->id,
                'passenger' => $ticket->passenger->fullname,
                'trip' => $ticket->trip->formatted_date. ' '. $ticket->trip->formatted_time,
                'departure' => $ticket->departure->name,
                'arrival' => $ticket->arrival->name,
            ];
        });
    }
}
