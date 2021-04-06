<?php

namespace App\Http\Fetch;

use App\Models\Voucher;
use App\Models\Passenger;

class VoucherFetch
{
    protected $voucher;
    protected $passenger;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Voucher $voucher, Passenger $passenger)
    {
        $this->voucher = $voucher;
        $this->passenger = $passenger;
    }

    /**
     * Handles querying of Voucher model
     * 
     * @param array $params
     * @return mixed $voucher
     */
    public function execute($params)
    {
        $this->voucher = $this->voucher->whereLike('code', $params['code'])
                                    ->orWhereLike('authorized_by', $params['authorized_by'])
                                    ->orWhereLike('type_of_voucher', $params['type_of_voucher']);
                                    
        if($params['passenger'] && $params['passenger'] != 'null') {
            $passengerId = $this->passenger->whereLike('first_name', $params['passenger'])->orWhereLike('last_name', $params['passenger'])->pluck('id')->toArray();
            $this->voucher = $this->voucher->whereIn('passenger_id', $passengerId);
        }

        return $this->voucher->paginate(20);
    }
}