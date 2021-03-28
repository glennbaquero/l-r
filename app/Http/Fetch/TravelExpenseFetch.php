<?php

namespace App\Http\Fetch;

use App\Models\Trip;
use App\Models\Route;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\City;
use App\Models\Stop;

class TravelExpenseFetch
{
    protected $trip;
    protected $route;
    protected $bus;
    protected $driver;
    protected $city;
    protected $stop;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Trip $trip, Route $route, Bus $bus, Driver $driver, City $city, Stop $stop)
    {
        $this->trip = $trip;
        $this->route = $route;
        $this->bus = $bus;
        $this->driver = $driver;
        $this->city = $city;
        $this->stop = $stop;
    }

    /**
     * Handles querying of trip model
     * 
     * @param array $params
     * @return mixed $trip
     */
    public function execute($params)
    {

        if($params['route_id'] && $params['route_id'] != 'null') {
            $this->trip = $this->trip->whereLike('route_id', $params['route_id']);
        }

        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $routeId = $this->route->whereIn('departure_id', $cityId)->pluck('id')->toArray();
            $this->trip = $this->trip->whereIn('route_id', $routeId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $routeId = $this->stop->whereIn('arrival_id', $cityId)->pluck('route_id')->toArray();
            $this->trip = $this->trip->whereIn('route_id', $routeId);
        }

        if($params['departure_id'] && $params['departure_id'] != 'null') {
            $cityId = $this->city->whereLike('id', $params['departure_id'])->pluck('id')->toArray();
            $routeId = $this->route->whereIn('departure_id', $cityId)->pluck('id')->toArray();
            $this->trip = $this->trip->whereIn('route_id', $routeId);
        }

        if($params['arrival_id'] && $params['arrival_id'] != 'null') {
            $cityId = $this->city->whereLike('id', $params['arrival_id'])->pluck('id')->toArray();
            $routeId = $this->stop->whereIn('arrival_id', $cityId)->pluck('route_id')->toArray();
            $this->trip = $this->trip->whereIn('route_id', $routeId);
        }

        if($params['date_range'] && $params['date_range'] != 'null') {
            $range = json_decode($params['date_range']);
            $this->trip = $this->trip->where('date', '>=', $range->from)->where('date', '<=', $range->to);
        } 

        if($params['date'] && $params['date'] != 'null') {
            $this->trip = $this->trip->whereDate('date', $params['date']);
        }

        return $this->trip->paginate(20);
    }
}