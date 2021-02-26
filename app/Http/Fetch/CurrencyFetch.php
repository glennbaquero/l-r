<?php

namespace App\Http\Fetch;

use App\Models\Currency;

class CurrencyFetch
{
    protected $currency;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Currency $currency)
    {
        $this->currency = $currency;
    }

    /**
     * Handles querying of group model
     * 
     * @param array $params
     * @return mixed $currency
     */
    public function execute($params)
    {
        $this->currency = $this->currency
                    ->whereLike('name', $params['name']);

        return $this->currency->paginate(20);
    }
}