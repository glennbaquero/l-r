<?php

namespace App\Http\Fetch;

use App\Models\Price;
use App\Models\City;
use App\Models\Currency;

class PriceFetch
{
    protected $price;
    protected $city;
    protected $currency;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Price $price, City $city, Currency $currency)
    {
        $this->price = $price;
        $this->city = $city;
        $this->currency = $currency;
    }

    /**
     * Handles querying of price model
     * 
     * @param array $params
     * @return mixed $price
     */
    public function execute($params)
    {
        $this->price = $this->price;
                    // ->whereLike('arrival_price', $params['arrival_price']);

        if($params['currency'] && $params['currency'] != 'null') {
            $currencyId = $this->currency->whereLike('name', $params['currency'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('currency_id', $currencyId);
        }

        if($params['departure_id'] && $params['departure_id'] != 'null') {
            $this->price = $this->price->where('departure_id', $params['departure_id']);
        }

        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('departure_id', $cityId);
        }

        if($params['departure_zone'] && $params['departure_zone'] != 'null') {
            $cityId = $this->city->where('destination_zone', $params['departure_zone'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('departure_id', $cityId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('arrival_id', $cityId);
        }

        if($params['destination_zone'] && $params['destination_zone'] != 'null') {
            $cityId = $this->city->where('destination_zone', $params['destination_zone'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('arrival_id', $cityId);
        }

        return $this->price->paginate(20);
    }
}