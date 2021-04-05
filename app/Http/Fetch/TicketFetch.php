<?php

namespace App\Http\Fetch;

use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\City;

class TicketFetch
{
    protected $ticket;
    protected $city;
    protected $passenger;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Ticket $ticket, City $city, Passenger $passenger)
    {
        $this->ticket = $ticket;
        $this->city = $city;
        $this->passenger = $passenger;
    }

    /**
     * Handles querying of ticket model
     * 
     * @param array $params
     * @return mixed $ticket
     */
    public function execute($params)
    {
        $this->ticket = $this->ticket;


        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $this->ticket = $this->ticket->whereIn('departure_id', $cityId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $this->ticket = $this->ticket->whereIn('arrival_id', $cityId);
        }

        if($params['passenger'] && $params['passenger'] != 'null') {
            $passengerId = $this->passenger->whereLike('first_name', $params['passenger'])->orWhereLike('last_name', $params['passenger'])->pluck('id')->toArray();
            $this->ticket = $this->ticket->whereIn('passenger_id', $passengerId);
        }

        return $this->ticket->paginate(20);
    }
}