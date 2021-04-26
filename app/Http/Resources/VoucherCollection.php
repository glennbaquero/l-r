<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class VoucherCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Code', 'Creation Date', 'Passenger', 'Amount', 'Amount Used', 'Amount Available', 'Expiration Date', 'Authorized By', 'Description', 'Action'
    ];

    public static $headers_max_courtesy_ticket = [
       'Code', 'Creation Date', 'Passenger', '# of Tickets Currently Used', '# of Tickets Courtesy Available', 'Expiration Date', 'Authorized By', 'Description', 'Action'
    ];

    public static $headers_discount = [
       'Code', 'Creation Date', 'Passenger', 'Discount Percent (%)', '# of Discounted Ticket', '# of Used Discounted Ticket', '# of Available Discounted Ticket', 'Expiration Date', 'Authorized By', 'Description', 'Action'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'code', 'passenger', 'authorized_by', 'type_of_voucher'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($voucher) {
            return [
                'passenger' => $voucher->passenger->fullname,
                'code' => $voucher->code,
                'created_at' => Carbon::parse($voucher->created_at)->format('Y-m-d h:i A'),
                'expiration_date' => Carbon::parse($voucher->expiration_date)->format('Y-m-d'),
                'authorized_by' => $voucher->authorized_by,
                'description' => $voucher->description,

                // Amount Header
                'amount' => $voucher->amount,
                'amount_used' => $voucher->amount_used,
                'amount_available' => $voucher->amount - $voucher->amount_used,

                // Max Courtesy Ticket
                'max_no_of_ticket_courtesy' => $voucher->max_no_of_ticket_courtesy,
                'no_of_ticket_courtesy_used' => $voucher->no_of_ticket_courtesy_used,
                'no_of_ticket_courtesy_available' => $voucher->max_no_of_ticket_courtesy - $voucher->no_of_ticket_courtesy_used,

                // Max Ticket % Discount
                'discount_percent' => $voucher->discount_percent,
                'max_no_of_discount_ticket' => $voucher->max_no_of_discount_ticket,
                'no_of_discount_ticket_used' => $voucher->no_of_discount_ticket_used,
                'no_of_discount_ticket_avaiable' => $voucher->max_no_of_discount_ticket - $voucher->no_of_discount_ticket_used,
                
                'showUrl' => route('voucher.show', $voucher->id),
                'deleteUrl' => route('voucher.destroy', $voucher->id),
            ];
        });
    }
}
