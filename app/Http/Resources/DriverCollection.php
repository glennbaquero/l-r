<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class DriverCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Document Type', 'Document No.', 'License Type', 'License No.', 'Phone Number', 'Address', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name', 'document_no', 'license_no'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($driver) {
            return [
                'fullname' => $driver->fullname,
                'document_type' => $driver->document_type,
                'document_no' => $driver->document_no,
                'license_type' => $driver->license_type,
                'license_no' => $driver->license_no,
                'phone_number' => $driver->phone_number,
                'address' => $driver->address,
                'showUrl' => route('driver.show', $driver->id),
                'deleteUrl' => route('driver.destroy', $driver->id),
            ];
        });
    }
}
