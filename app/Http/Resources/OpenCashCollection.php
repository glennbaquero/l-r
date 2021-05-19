<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class OpenCashCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Amount', 'Opening Date', 'Office', 
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
        return $this->collection->map(function($cash) {
            return [
                'office' => $cash->office ? $cash->office->name : '---',
                'amount' => number_format($cash->cash, 2, '.', ','),
                'opening_date' => Carbon::parse($cash->created_at)->format('M d, Y h:i A'),
            ];
        });
    }
}
