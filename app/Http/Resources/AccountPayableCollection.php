<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class AccountPayableCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Date', 'Amount', 'Actions'
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
        return $this->collection->map(function($item) {
            return [
                'id' => $item->id,
                'name' => $item->name,
                'amount' => $item->amount,
                'date' => Carbon::parse($item->date)->format('m-d-Y g:i A'),
                'showUrl' => route('account-payable.show', $item->id),
                'deleteUrl' => route('account-payable.destroy', $item->id),
            ];
        });
    }
}
