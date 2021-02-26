<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\ResourceCollection;

class CurrencyCollection extends ResourceCollection
{
    /**
     * Fields that are used for table headers
     * 
     * @var array 
     */
    public static $headers = [
       'Name', 'Symbol', 'Equivalency in Dollars', 'Country', 'Default', 'Actions'
    ];

    /**
     * Fields that are used for searching
     * 
     * @var array
     */
    public static $searches = [
        'name'
    ];

    /**
     * Transform the resource collection into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return $this->collection->map(function($currency) {
            return [
                'name' => $currency->name,
                'equivalent_in_dollars_principle_tills' => $currency->equivalent_in_dollars_principle_tills,
                'equivalent_in_dollars_additional_tills' => $currency->equivalent_in_dollars_additional_tills,
                'symbol' => $currency->symbol,
                'default_currency' => $currency->default_currency,
                'country' => $currency->country,
                'deleteUrl' => route('currency.destroy', $currency->id),
                'showUrl' => route('currency.show', $currency->id),
            ];
        });
    }
}
