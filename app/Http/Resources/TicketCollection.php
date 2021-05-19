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
       'Departure', 'Arrival', 'Travel Date', 'Seat', 'Passenger', 'Type', 'Price', 'Actions'
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
                'id' => $ticket->id,

                'is_selected' => false, 
                'departure' => $ticket->departure ? $ticket->departure->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'travel_date' => Carbon::parse($ticket->trip->date.' '.$ticket->trip->time)->format('Y-m-d h:i A'),
                'seat' => $ticket->passenger->bus_model_column->label,
                'passenger' => $ticket->passenger ? $ticket->passenger->fullname : '---',
                'type' => $ticket->passenger->ticketType ? $ticket->passenger->ticketType->name : '---',
                'price' => number_format($ticket->total_sale, 2, '.', ','),

                'passenger_info' => $ticket->passenger,
                'trip_id' => $ticket->trip->id,
                'trip' => $ticket->trip,
                'departure_id' => $ticket->departure_id,
                'arrival_id' => $ticket->arrival_id,
                'payment_method' => $ticket->payment_method,
                'cash' => $ticket->total_sale,
                'total_sale' => $ticket->total_sale,
                'code' => $ticket->voucher_code,
                'seat_id' => $ticket->bus_model_column_id,

                'is_cancelled' => $ticket->is_cancelled,

                'printUrl' => route('ticket.print', [$ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name]),
                'cancelUrl' => route('ticket.cancel', $ticket->id),
                'updateUrl' => route('ticket.update', $ticket->id),
                'sendEmailUrl' => route('ticket.send-email', $ticket->passenger->id),
            ];
        });
    }
}
