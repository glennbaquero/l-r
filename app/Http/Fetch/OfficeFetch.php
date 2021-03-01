<?php

namespace App\Http\Fetch;

use App\Models\Office;

class OfficeFetch
{
    protected $office;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Office $office)
    {
        $this->office = $office;
    }

    /**
     * Handles querying of office model
     * 
     * @param array $params
     * @return mixed $office
     */
    public function execute($params)
    {
        $this->office = $this->office
                        ->whereLike('office_no', $params['office_no'])
                        ->orWhereLike('name', $params['name'])
                        ->orWhereLike('address_line_1', $params['address_line_1'])
                        ->orWhereLike('phone_number', $params['phone_number'])
                        ->orWhereLike('city', $params['city'])
                        ->orWhereLike('state', $params['state']);

        return $this->office->paginate(20);
    }
}