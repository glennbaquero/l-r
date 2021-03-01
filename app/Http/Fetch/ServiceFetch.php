<?php

namespace App\Http\Fetch;

use App\Models\Service;

class ServiceFetch
{
    protected $service;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Service $service)
    {
        $this->service = $service;
    }

    /**
     * Handles querying of service model
     * 
     * @param array $params
     * @return mixed $service
     */
    public function execute($params)
    {
        $this->service = $this->service
                    ->whereLike('name', $params['name']);

        return $this->service->paginate(20);
    }
}