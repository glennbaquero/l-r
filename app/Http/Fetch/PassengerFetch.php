<?php

namespace App\Http\Fetch;

use App\Models\Passenger;

class PassengerFetch
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
        $this->passenger = $this->passenger->whereLike('first_name', $params['name'])
                                        ->orWhereLike('last_name', $params['name'])
                                        ->orWhereLike('email', $params['email'])
                                        ->orWhereLike('phone_number', $params['phone_number']);

        if($params['type'] && $params['type'] != 'null') {
            switch($params['type']) {
                case 'all':
                    $this->passenger = $this->passenger;
                    break;
                case 'solo':
                    $this->passenger = $this->passenger;
                    break;
                case 'student':
                    $this->passenger = [];
                    break;
            }
        }
                                        
        return $this->passenger ? $this->passenger->paginate(20) : [];
    }
}