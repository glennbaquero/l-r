<?php

namespace App\Http\Fetch;

use App\Models\Driver;

class DriverFetch
{
    protected $driver;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Driver $driver)
    {
        $this->driver = $driver;
    }

    /**
     * Handles querying of driver model
     * 
     * @param array $params
     * @return mixed $driver
     */
    public function execute($params)
    {
        $this->driver = $this->driver
                    ->whereLike('first_name', $params['name'])
                    ->orWhereLike('last_name', $params['name'])
                    ->orWhereLike('license_type', $params['license_type'])
                    ->orWhereLike('phone_number', $params['phone_number'])
                    ->orWhereLike('document_no', $params['document_no'])
                    ->orWhereLike('license_no', $params['license_no']);

        return $this->driver->paginate(20);
    }
}