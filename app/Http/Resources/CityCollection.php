<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CityCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Actions'
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
        return $this->collection->map(function($city) {
            return [
                'name' => $city->name,
                'deleteUrl' => route('city.destroy', $city->id),
                'showUrl' => route('city.show', $city->id),
            ];
        });
    }
}
