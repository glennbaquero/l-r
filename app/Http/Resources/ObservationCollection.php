<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

use Carbon\Carbon;

class ObservationCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
      'Observation', 'Recorded By', 'Date'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
       'trip_id'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($observation) {
            return [
                'observation' => $observation->observation,
                'recorded_by' => $observation->observation_by,
                'date' => Carbon::parse($observation->created_at)->format('m-d-Y'),
                // 'deleteUrl' => route('trip.destroy', $trip->id),
            ];
        });
    }
}
