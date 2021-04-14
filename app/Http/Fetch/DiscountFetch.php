<?php

namespace App\Http\Fetch;

use App\Models\Discount;

class DiscountFetch
{
    protected $discount;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Discount $discount)
    {
        $this->discount = $discount;
    }

    /**
     * Handles querying of discount model
     * 
     * @param array $params
     * @return mixed $discount
     */
    public function execute($params)
    {
        $this->discount = $this->discount
                    ->whereLike('id', $params['id'])
                    ->orWhereLike('filter_day', $params['filter_day'])
                    ->orWhereLike('promotion_apply_to', $params['applicable'])
                    ->orWhereLike('option', $params['option'])
                    ->orWhereLike('change_type', $params['change_type'])
                    ->orWhereLike('date', $params['date'])
                    ->orWhereLike('end_date', $params['end_date'])
                    ->orWhereLike('type', $params['type'])
                    ->orWhereLike('amount', $params['amount'])
                    ->orWhereLike('filter_by', $params['filter_by'])
                    ->orWhereLike('partnership', $params['partnership'])
                    ->orWhereLike('apply_to', $params['apply_to']);

        return $this->discount->paginate(20);
    }
}