<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class BusCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Model', 'Plate', 'Seats', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name', 'model', 'plate'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($bus) {
            return [
                'name' => $bus->name,
                'plate' => $bus->plate,
                'model' => $bus->bus_model->name,
                'seat' => $bus->bus_model->seats,
                'showUrl' => route('bus.show', $bus->id),
                'deleteUrl' => route('bus.destroy', $bus->id),
            ];
        });
    }
}
