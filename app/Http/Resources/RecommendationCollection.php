<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class RecommendationCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'From Youtube', 'Actions'
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
        return $this->collection->map(function($recommendation) {
            return [
                'name' => $recommendation->name,
                'from_youtube' => $recommendation->from_youtube,
                'showUrl' => route('recommendation.show', $recommendation->id),
                'deleteUrl' => route('recommendation.destroy', $recommendation->id),
            ];
        });
    }
}
