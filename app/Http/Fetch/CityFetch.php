<?php

namespace App\Http\Fetch;

use App\Models\City;

class CityFetch
{
    protected $city;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(City $city)
    {
        $this->city = $city;
    }

    /**
     * Handles querying of group model
     * 
     * @param array $params
     * @return mixed $city
     */
    public function execute($params)
    {
        $this->city = $this->city
                    ->whereLike('name', $params['name']);

        return $this->city->paginate(20);
    }
}