<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class TicketSupportCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Purchase Date', 'Passenger', 'Phone Number', 'Email', 'Document', 'Departure', 'Arrival', 'Price', 'Seat', 'Travel Date', 'State', 'Seller', 'Sales Office', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'purchase_date', 'passenger', 'document', 'email', 'phone_number', 'departure', 'arrival', 'price', 'travel_date', 'user', 'date_box', 'state'
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
                'purchase_date' => Carbon::parse($ticket->purchase_date)->format('m-d-Y g:i A'),
                'passenger' => $ticket->passenger->fullname,
                'document' => '---',
                'phone_number' => $ticket->passenger->phone_number,
                'email' => $ticket->passenger->email,
                'departure' => $ticket->departure->name,
                'arrival' => $ticket->arrival->name,
                'price' => number_format($ticket->total_sale, 2, '.', ','),
                'seat' => $ticket->passenger->bus_model_column->label,
                'travel_date' => Carbon::parse($ticket->passenger->trip->date.' '.$ticket->passenger->trip->time)->format('m-d-Y g:i A'),
                'state' => $ticket->passenger->state,
                'seller' => $ticket->seller->fullname,
                'office' => $ticket->seller->office->name,
                'ticket_type' => $ticket->passenger->ticketType->name,
                'payment_method' => $ticket->payment_method,
                'status' => $ticket->payment_status.'/'.$ticket->boarding_status,
                'reservation_date' => $ticket->trip->formatted_date.' '.$ticket->trip->formatted_time,
                'total_sale' => number_format($ticket->total_sale, 2, '.', ','),
            ];
        });
    }
}
