<?php

namespace App\Http\Fetch;

use App\Models\ExpenseIncome;
use App\Models\User;
use App\Models\Office;

class ExpenseIncomeFetch
{
    protected $item;
    protected $user;
    protected $office;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(ExpenseIncome $item, User $user, Office $office)
    {
        $this->item = $item;
        $this->user = $user;
        $this->office = $office;
    }

    /**
     * Handles querying of Voucher model
     * 
     * @param array $params
     * @return mixed $item
     */
    public function execute($params)
    {
        if($params['authorized'] && $params['authorized'] != 'null') {
            $passengerId = $this->user->whereLike('firstname', $params['authorized'])->orWhereLike('lastname', $params['authorized'])->pluck('id')->toArray();
            $this->item = $this->item->whereIn('authorized_by', $passengerId);
        }
                     
        if($params['created_by'] && $params['created_by'] != 'null') {
            $passengerId = $this->user->whereLike('firstname', $params['created_by'])->orWhereLike('lastname', $params['created_by'])->pluck('id')->toArray();
            $this->item = $this->item->whereIn('created_by', $passengerId);
        }
                     
        if($params['office'] && $params['office'] != 'null') {
            $officeId = $this->office->whereLike('name', $params['office'])->pluck('id')->toArray();
            $userId = $this->user->whereIn('office_id', $officeId)->pluck('id')->toArray();
            $this->item = $this->item->whereIn('created_by', $userId);
        }

        return $this->item->paginate(20);
    }
}