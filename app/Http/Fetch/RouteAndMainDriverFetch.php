<?php

namespace App\Http\Fetch;

use App\Models\RouteAndMainDriver;

class RouteAndMainDriverFetch
{
    protected $item;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(RouteAndMainDriver $item)
    {
        $this->item = $item;
    }

    /**
     * Handles querying of RouteAndMainDriver model
     * 
     * @param array $params
     * @return mixed $item
     */
    public function execute($params)
    {
        return $this->item->paginate(20);
    }
}