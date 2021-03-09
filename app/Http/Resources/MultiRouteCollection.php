<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class MultiRouteCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'ID', 'Alias', 'Departure', 'Arrival', 'Type', 'Sections', 'One Way Multi Route', 'Options'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'id', 'alias', 'departure', 'arrival', 'type', 'sections', 'one_way_multi_route'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($route) {
            return [
                'id' => $route->id,
                'alias' => $route->alias,
                'departure' => $route->stops()->latest()->orderby('id', 'asc')->first()->departure->name,
                'arrival' => $route->stops()->latest()->orderby('id', 'desc')->first()->arrival->name,
                'type' => $route->type,
                'sections' => $route->stops()->count(),
                'one_way_multi_route' => $route->one_way_multi_route,
                'showUrl' => route('multi-route.show', $route->id),
                'deleteUrl' => route('multi-route.destroy', $route->id),
            ];
        });
    }
}
