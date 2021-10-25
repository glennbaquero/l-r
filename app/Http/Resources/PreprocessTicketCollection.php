<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class PreprocessTicketCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Departure', 'Arrival', 'Travel Date', 'Seat', 'Passenger', 'Type', 'Price', 'Actions'
    ];

    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $account_receivable_headers = [
       'Ticket', 'Purchase Date', 'Departure City', 'Arrival City', 'Travel Date', 'Passenger', 'Office', 'Amount', 'Commission', 'Amount Receivable', 'Amount Paid', 'Balance'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'departure', 'arrival', 'passenger', 'office_id', 'date', 'trip', 'type', 'travel_date', 'end_date', 'has_end_date', 'office_view', 'ticket_number'
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

            $trip_time = $ticket->trip_time ? $ticket->trip_time->formatted_time : now()->format('h:i A');

            return [
                'id' => $ticket->id,
                'ticket_number' => $ticket->ticket_number,

                'is_selected' => false, 
                'departure' => $ticket->departure ? $ticket->departure->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                'travel_date' => Carbon::parse($ticket->trip->date)->format('Y-m-d'). ' '. $trip_time,
                'seat' => $ticket->passenger->bus_model_column->label,
                'passenger' => $ticket->passenger ? $ticket->passenger->fullname : '---',
                'type' => $ticket->passenger->ticketType ? $ticket->passenger->ticketType->name : '---',


                // ACcount Receivable 
                
                'ticket' => $ticket->id,
                'purchase_date' => Carbon::parse($ticket->purchase_date)->format('Y-m-d h:i A'),
                'departure' => $ticket->departure ? $ticket->departure->name : '---',
                'arrival' => $ticket->arrival ? $ticket->arrival->name : '---',
                // 'travel_date' => Carbon::parse($ticket->trip->date.' '.$ticket->trip->time)->format('Y-m-d h:i A'),
                'passenger' => $ticket->passenger ? $ticket->passenger->fullname : '---',
                'office' => $ticket->office ? $ticket->office->name : $ticket->seller->office->name,
                'amount' => number_format($ticket->total_sale, 2, '.', ','),
                'commssion' => 0.00,
                'receivable' => number_format($ticket->total_sale, 2, '.', ','),
                'amount_paid' => number_format($ticket->total_sale, 2, '.', ','),
                'balance' => 0.00,
                'price' => number_format($ticket->total_sale, 2, '.', ','),

                'passenger_info' => $ticket->passenger,
                'trip_id' => $ticket->trip->id,
                'trip' => $ticket->trip,
                'date' => $ticket->trip->date,
                'departure_id' => $ticket->departure_id,
                'arrival_id' => $ticket->arrival_id,
                'payment_method' => $ticket->payment_method,
                'cash' => $ticket->total_sale,
                'total_sale' => $ticket->total_sale,
                'code' => $ticket->voucher_code,
                'seat_id' => $ticket->bus_model_column_id,
                'time_id' => $ticket->trip_time_id,
                'time' => $ticket->trip_time,

                'is_cancelled' => $ticket->is_cancelled,
                'type_of_ticket' => $ticket->type_of_ticket,

                'printUrl' => route('ticket.print', [$ticket->ticket_number, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name, true]),
                'cancelUrl' => route('ticket.cancel', $ticket->id),
                'updateUrl' => route('ticket.update', $ticket->id),
                'sendEmailUrl' => route('ticket.send-email', $ticket->passenger->id),
            ];
        });
    }
}
