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
        return $this->collection->map(function($office) {
            return [
                'office_no' => $office->office_no,
                'name' => $office->name,
                'address_line_1' => $office->address_line_1,
                'phone_number' => $office->phone_number,
                'city' => $office->departure ? $office->departure->name : '---',
                'state' => $office->state_name,
                'office_type' => $office->officeType->name,
                'status' => $office->status,
                'showUrl' => route('office.show', $office->id),
                'deleteUrl' => route('office.destroy', $office->id),
            ];
        });
    }
}
