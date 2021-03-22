<?php

namespace App\Http\Fetch;

use App\Models\Observation;

class ObservationFetch
{
    protected $observation;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Observation $observation)
    {
        $this->observation = $observation;
    }

    /**
     * Handles querying of passenger model
     * 
     * @param array $params
     * @return mixed $observation
     */
    public function execute($params)
    {
        $this->observation = $this->observation->where('trip_id', $params['trip_id']);
      
        return $this->observation->paginate(20);
    }
}