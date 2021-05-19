<?php

namespace App\Http\Fetch;

use App\Models\Coupon;
use App\Models\Ticket;

class MostUsedCouponFetch
{
    protected $coupon;
    protected $ticket;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Coupon $coupon, Ticket $ticket)
    {
        $this->coupon = $coupon;
        $this->ticket = $ticket;
    }

    /**
     * Handles querying of coupon model
     * 
     * @param array $params
     * @return mixed $coupon
     */
    public function execute($params)
    {
        $this->ticket = $this->ticket->whereNotNull('voucher_code');
        // $this->coupon = $this->coupon->orderBy('coupon_used', 'desc')->whereIn('code', $coupon_code);

        return $this->ticket->paginate(20);
    }
}