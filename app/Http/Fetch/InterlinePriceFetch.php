<?php

namespace App\Http\Fetch;

use App\Models\InterlinePrice;
use App\Models\City;
use App\Models\Currency;
use App\Models\Company;

class InterlinePriceFetch
{
    protected $price;
    protected $city;
    protected $currency;
    protected $company;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(InterlinePrice $price, City $city, Currency $currency, Company $company)
    {
        $this->price = $price;
        $this->city = $city;
        $this->currency = $currency;
        $this->company = $company;
    }

    /**
     * Handles querying of price model
     * 
     * @param array $params
     * @return mixed $price
     */
    public function execute($params)
    {
        $this->price = $this->price
                    ->whereLike('arrival_price', $params['arrival_price']);

        if($params['company'] && $params['company'] != 'null') {
            $companyId = $this->company->whereLike('name', $params['company'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('company_id', $companyId);
        }

        if($params['currency'] && $params['currency'] != 'null') {
            $currencyId = $this->currency->whereLike('name', $params['currency'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('currency_id', $currencyId);
        }

        if($params['departure'] && $params['departure'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['departure'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('departure_id', $cityId);
        }

        if($params['arrival'] && $params['arrival'] != 'null') {
            $cityId = $this->city->whereLike('name', $params['arrival'])->pluck('id')->toArray();
            $this->price = $this->price->whereIn('arrival_id', $cityId);
        }

        return $this->price->paginate(20);
    }
}