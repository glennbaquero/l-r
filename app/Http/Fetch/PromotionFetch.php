<?php

namespace App\Http\Fetch;

use App\Models\Promotion;
use App\Models\Route;
use App\Models\City;

class PromotionFetch
{
    protected $promotion;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Promotion $promotion)
    {
        $this->promotion = $promotion;
    }

    /**
     * Handles querying of promotion model
     * 
     * @param array $params
     * @return mixed $promotion
     */
    public function execute($params)
    {
        return $this->promotion->paginate(20);
    }
}