<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class BaggageCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Ticket ID', 'Alias', 'Series', 'Correlative', 'Passenger', 'Total Weight', 'Total Amount', 'Received Amount', 'Return Cash', 'User Registration', 'Record Date', 'State', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'ticket_id', 'alias', 'series', 'correlative', 'passenger', 'user', 'record_date'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($baggage) {
            return [
                'id' => $baggage->id,
                'ticket' => $baggage->ticket->id,
                'alias' => $baggage->alias,
                'series' => $baggage->series,
                'correlative' => $baggage->correlative,
                'passenger' => $baggage->ticket->passenger->fullname,
                'total_weight' => $baggage->total_weight,
                'total_amount' => $baggage->total_amount,
                'received_amount' => $baggage->received_amount,
                'return_cash' => $baggage->return_cash,
                'user' => $baggage->user->fullname,
                'record_date' => Carbon::parse($baggage->record_date)->format('m-d-Y g:i A'),
                'state' => $baggage->state,
                'showUrl' => route('baggage.show', $baggage->id),
                'deleteUrl' => route('baggage.destroy', $baggage->id),
            ];
        });
    }
}
