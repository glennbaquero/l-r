<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class OfficeCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
        'Office No.', 'Name', 'Address', 'Phone', 'City', 'State', 'Office Type', 'Office Status', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'office_no', 'name', 'address_line_1', 'phone_number', 'city', 'state', 'office_type'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($collection) {
            return [
                'office_no' => $collection->office_no,
                'name' => $collection->name,
                'address_line_1' => $collection->address_line_1,
                'phone_number' => $collection->phone_number,
                'city' => $collection->city,
                'state' => $collection->state,
                'office_type' => $collection->officeType->name,
                'status' => $collection->status,
            ];
        });
    }
}
