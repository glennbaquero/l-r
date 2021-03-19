<?php

namespace App\Http\Fetch;

use App\Models\Trip;

class DailyItineraryFetch
{
    protected $trip;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Trip $trip)
    {
        $this->trip = $trip;
    }

    /**
     * Handles querying of trip model
     * 
     * @param array $params
     * @return mixed $trip
     */
    public function execute($params)
    {
        $this->trip = $this->trip->whereDate('date', now())->orderBy('time', 'asc');


        return $this->trip->paginate(20);
    }
}