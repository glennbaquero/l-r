<?php

namespace App\Http\Fetch;

use App\Models\Coupon;

class CouponFetch
{
    protected $coupon;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Coupon $coupon)
    {
        $this->coupon = $coupon;
    }

    /**
     * Handles querying of coupon model
     * 
     * @param array $params
     * @return mixed $coupon
     */
    public function execute($params)
    {
        $this->coupon = $this->coupon
                    ->whereLike('promotion_name', $params['name'])
                    ->orWhereLike('code', $params['code'])
                    ->orWhereLike('value', $params['value'])
                    ->orWhereLike('coupon_type', $params['type'])
                    ->orWhereLike('created_at', $params['created_at'])
                    ->orWhereLike('promotion_alias', $params['alias']);

        return $this->coupon->paginate(20);
    }
}