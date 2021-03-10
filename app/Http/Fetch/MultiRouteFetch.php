<?php

namespace App\Http\Fetch;

use App\Models\MultiRoute;
use App\Models\City;
use App\Models\MultiRouteStop;

class MultiRouteFetch
{
    protected $route;
    protected $city;
    protected $stop;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(MultiRoute $route, City $city, MultiRouteStop $stop)
    {
        $this->route = $route;
        $this->city = $city;
        $this->stop = $stop;
    }

    /**
     * Handles querying of route model
     * 
     * @param array $params
     * @return mixed $route
     */
    public function execute($params)
    {
        $this->route = $this->route
                    ->whereLike('alias', $params['alias'])
                    ->orWhereLike('type', $params['type'])
                    ->orWhereLike('id', $params['id']);

        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $routeId = $this->stop->whereIn('departure_id', $cityId)->pluck('multi_route_id')->toArray();
            $this->route = $this->route->whereIn('id', $routeId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $routeId = $this->stop->whereIn('arrival_id', $cityId)->pluck('multi_route_id')->toArray();
            $this->route = $this->route->whereIn('id', $routeId);
        }

        return $this->route->paginate(20);
    }
}