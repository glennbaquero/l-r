<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class TicketCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Departure', 'Arrival', 'Travel Date', 'Seat', 'Passenger', 'Type', 'Price', 'T. Or.', 'T. Des.', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'departure', 'arrival', 'passenger'
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
                'is_selected' => false, 
                'departure' => $ticket->departure ? $ticket->departure->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'travel_date' => Carbon::parse($ticket->trip->date.' '.$ticket->trip->time)->format('Y-m-d h:i A'),
                'seat' => $ticket->passenger->bus_model_column->label,
                'passenger' => $ticket->passenger ? $ticket->passenger->fullname : '---',
                'type' => $ticket->passenger->ticketType ? $ticket->passenger->ticketType->name : '---',
                'price' => $ticket->total_sale,
                't_des' => '---',
                't_or' => '---',
            ];
        });
    }
}
