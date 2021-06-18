<?php

namespace App\Http\Fetch;

use App\Models\AccountPayable;

class AccountPayableFetch
{
    protected $item;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(AccountPayable $item)
    {
        $this->item = $item;
    }

    /**
     * Handles querying of account payable model
     * 
     * @param array $params
     * @return mixed $item
     */
    public function execute($params)
    {
        $this->item = $this->item
                    ->whereLike('name', $params['name']);

        return $this->item->paginate(20);
    }
}