<?php

namespace App\Http\Fetch;

use App\Models\Baggage;
use App\Models\User;
use App\Models\Passenger;
use App\Models\Ticket;
use App\Models\City;

class TicketSupportFetch
{
    protected $city;
    protected $user;
    protected $passenger;
    protected $ticket;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(City $city, User $user, Passenger $passenger, Ticket $ticket)
    {
        $this->city = $city;
        $this->user = $user;
        $this->passenger = $passenger;
        $this->ticket = $ticket;
    }

    /**
     * Handles querying of ticket model
     * 
     * @param array $params
     * @return mixed $ticket
     */
    public function execute($params)
    {
        $this->ticket = $this->ticket
                    ->whereLike('id', $params['id'])
                    ->orWhereLike('purchase_date', $params['purchase_date']);


        if($params['user'] && $params['user'] != 'null') {
            $this->ticket = $this->ticket->where('seller_id', $params['user']);
        }

        if($params['passenger'] && $params['passenger'] != 'null' || $params['email'] && $params['email'] != 'null' || $params['phone_number'] && $params['phone_number'] != 'null') {
            $passengerId = $this->passenger
                        ->whereLike('first_name', $params['passenger'])
                        ->orWhereLike('last_name', $params['passenger'])
                        ->orWhereLike('email', $params['email'])
                        ->orWhereLike('phone_number', $params['passenger'])
                        ->pluck('id')->toArray();

            $this->ticket = $this->ticket->whereIn('passenger_id', $passengerId);
        }

        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $this->ticket = $this->ticket->whereIn('departure_id', $cityId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $this->ticket = $this->ticket->whereIn('arrival_id', $cityId);
        }

        return $this->ticket->paginate(20);
    }
}