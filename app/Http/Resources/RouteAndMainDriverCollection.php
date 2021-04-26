<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class RouteAndMainDriverCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Code Reference', 'Departure', 'Arrival', 'Driver', 'Issue Date', 'Seat', 'State', 'Travel Date', 'Series', 'Correlative', 'Price', 'Currency', 'Action'
    ];

    public static $headers_voucher_route = [
       'Code Reference', 'Issue Date', 'State', 'Document Type', 'Type', 'Description', 'Series', 'Correlative', 'Price', 'Currency', 'Action'
    ];

    public static $headers_excess_luggage = [
       'Issue Date', 'State', 'Document Type', 'Description', 'Series', 'Correlative', 'Price', 'Currency', 'Action'
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
        return $this->collection->map(function($item) {
            return [
                'type_of_record' => $item->type_of_record,
                'code_reference' => $item->code_reference,
                'issued_date' => $item->issued_date,
                'state' => $item->state, 
                'series' => $item->series, 
                'correlative' => $item->correlative, 
                'price' => $item->price, 
                'price' => $item->price, 
                'currency' => 'Dollar', 

                // ticket route
                'departure' => $item->departure ? $item->departure->name : '---',
                'arrival' => $item->arrival ? $item->arrival->name : '---',
                'driver' => $item->driver ? $item->driver->fullname : '---',
                'seat' => $item->seat,
                'travel_date' => $item->travel_date,

                // voucher
                'voucher_type' => $item->voucher_type,
                'document_type' => '---', 
                'description' => $item->description, 
                
                'showUrl' => route('route-main-driver.show', $item->id),
                'deleteUrl' => route('route-main-driver.destroy', $item->id),
            ];
        });
    }
}
