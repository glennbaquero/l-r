<?php

namespace App\Http\Fetch;

use App\Models\Cash;

class OpenCashFetch
{
    protected $cash;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Cash $cash)
    {
        $this->cash = $cash;
    }

    /**
     * Handles querying of cash model
     * 
     * @param array $params
     * @return mixed $cash
     */
    public function execute($params)
    {
        $user = auth()->user();
        $this->cash = $this->cash->whereDate('created_at', now());

        return $this->cash->paginate(20);
    }
}