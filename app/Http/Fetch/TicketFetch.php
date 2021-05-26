<?php

namespace App\Http\Fetch;

use App\Models\Ticket;
use App\Models\Passenger;
use App\Models\City;
use App\Models\Office;
use App\Models\Trip;

class TicketFetch
{
    protected $ticket;
    protected $city;
    protected $passenger;
    protected $office;
    protected $trip;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Ticket $ticket, City $city, Passenger $passenger, Office $office, Trip $trip)
    {
        $this->ticket = $ticket;
        $this->city = $city;
        $this->passenger = $passenger;
        $this->office = $office;
        $this->trip = $trip;
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


        if($params['trip'] && $params['trip'] != 'null') {
            $this->ticket = $this->ticket->where('trip_id', $params['trip']);
        }

        if($params['type'] && $params['type'] != 'null') {
            if($params['type'] == 'sold') {
                $this->ticket = $this->ticket->where('payment_status', 'Paid');
            } 

            if($params['type'] == 'reserved') {
                $this->ticket = $this->ticket->where('payment_status', 'Reserved');
            } 
            
            if($params['type'] == 'boarded') {
                $this->ticket = $this->ticket->where('boarding_status', 'Boarded');
            } 
        }


        if($params['date'] && $params['date'] != 'null') {
            $this->ticket = $this->ticket->whereDate('purchase_date', $params['date']);
        }


        if($params['travel_date'] && $params['travel_date'] != 'null') {
            $trip_ids = $this->trip->whereDate('date', $params['travel_date'])->pluck('id');
            $this->ticket = $this->ticket->whereIn('trip_id', $trip_ids);
        }
        
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

        if($params['office_id'] && $params['office_id'] != 'null') {
            $office_id = $params['office_id'];
            $seller_ids = $this->ticket->whereHas('seller', function($seller) use($office_id) {
                $seller->where('office_id', $office_id);
            })->pluck('id')->toArray();

            $this->ticket = $this->ticket->whereIn('seller_id', $seller_ids);
        }

        return $this->ticket->paginate(20);
    }
}