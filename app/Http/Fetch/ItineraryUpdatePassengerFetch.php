<?php

namespace App\Http\Fetch;

use App\Models\Passenger;

class ItineraryUpdatePassengerFetch
{
    protected $passenger;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Passenger $passenger)
    {
        $this->passenger = $passenger;
    }

    /**
     * Handles querying of passenger model
     * 
     * @param array $params
     * @return mixed $passenger
     */
    public function execute($params)
    {
        $this->passenger = $this->passenger->where('trip_id', $params['trip_id']);
      
        return $this->passenger->paginate(20);
    }
}