<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class ServiceCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Description', 'External Services', 'Actions'
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
        return $this->collection->map(function($service) {
            return [
                'name' => $service->name,
                'description' => $service->description,
                'apply_external_services' => $service->apply_external_services,
                'showUrl' => route('service.show', $service->id),
                'deleteUrl' => route('service.destroy', $service->id),
            ];
        });
    }
}
