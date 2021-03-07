<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class TicketTypeCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Type', 'Discount', 'Websales', 'Document Type', 'Created By', 'Created Date', 'Edited By', 'Edited Date', 'Action'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($ticket_type) {
            return [
                'name' => $ticket_type->name,
                'available_sale_web' => $ticket_type->available_sale_web,
                'discount_type' => $ticket_type->discount_type,
                'document_type' => $ticket_type->document_type->name,
                'discount' => $ticket_type->discount,
                'return_discount' => $ticket_type->return_discount,
                'required_authorization' => $ticket_type->required_authorization,
                'required_email' => $ticket_type->required_email,
                'required_telephone' => $ticket_type->required_telephone,
                'message' => $ticket_type->message,
                'show_message' => $ticket_type->show_message,
                'created_by' => $ticket_type->created_by_user ? $ticket_type->created_by_user->fullname : '---',
                'edited_by' => $ticket_type->updated_by_user ? $ticket_type->updated_by_user->fullname : '---',
                'created_at' => Carbon::parse($ticket_type->created_at)->format('F d, Y'),
                'updated_at' => Carbon::parse($ticket_type->updated_at)->format('F d, Y'),
                'showUrl' => route('ticket-type.show', $ticket_type->id),
                'deleteUrl' => route('ticket-type.destroy', $ticket_type->id),
            ];
        });
    }
}
