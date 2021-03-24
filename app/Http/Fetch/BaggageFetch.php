<?php

namespace App\Http\Fetch;

use App\Models\Baggage;
use App\Models\User;
use App\Models\Passenger;
use App\Models\Ticket;

class BaggageFetch
{
    protected $baggage;
    protected $user;
    protected $passenger;
    protected $ticket;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Baggage $baggage, User $user, Passenger $passenger, Ticket $ticket)
    {
        $this->baggage = $baggage;
        $this->user = $user;
        $this->passenger = $passenger;
        $this->ticket = $ticket;
    }

    /**
     * Handles querying of baggage model
     * 
     * @param array $params
     * @return mixed $baggage
     */
    public function execute($params)
    {
        $this->baggage = $this->baggage
                    ->whereLike('id', $params['id'])
                    ->orWhereLike('ticket_id', $params['ticket_id'])
                    ->orWhereLike('series', $params['series'])
                    ->orWhereLike('correlative', $params['correlative'])
                    ->orWhereLike('record_date', $params['record_date'])
                    ->orWhereLike('alias', $params['alias']);



        if($params['user'] && $params['user'] != 'null') {
            $userId = $this->user
                        ->whereLike('firstname', $params['user'])
                        ->orWhereLike('lastname', $params['user'])
                        ->pluck('id')->toArray();
            $this->baggage = $this->baggage->whereIn('user_id', $userId);
        }

        if($params['passenger'] && $params['passenger'] != 'null') {
            $passengerId = $this->passenger
                        ->whereLike('first_name', $params['passenger'])
                        ->orWhereLike('last_name', $params['passenger'])
                        ->pluck('id')->toArray();

            $ticketId = $this->ticket->whereIn('passenger_id', $passengerId)->pluck('id')->toArray();
            $this->baggage = $this->baggage->whereIn('ticket_id', $ticketId);
        }

        return $this->baggage->paginate(20);
    }
}