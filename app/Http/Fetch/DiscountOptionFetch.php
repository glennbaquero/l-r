<?php

namespace App\Http\Fetch;

use App\Models\DiscountIncreaseOption;

class DiscountOptionFetch
{
    protected $option;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(DiscountIncreaseOption $option)
    {
        $this->option = $option;
    }

    /**
     * Handles querying of DiscountIncreaseOption model
     * 
     * @param array $params
     * @return mixed $option
     */
    public function execute($params)
    {
        $this->option = $this->option->whereLike('option_name', $params['option_name'])
                                    ->orWhereLike('option_type', $params['option_type']);

        return $this->option->paginate(20);
    }
}