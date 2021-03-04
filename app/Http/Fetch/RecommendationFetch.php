<?php

namespace App\Http\Fetch;

use App\Models\Recommendation;

class RecommendationFetch
{
    protected $recommendation;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Recommendation $recommendation)
    {
        $this->recommendation = $recommendation;
    }

    /**
     * Handles querying of recommendation model
     * 
     * @param array $params
     * @return mixed $recommendation
     */
    public function execute($params)
    {
        $this->recommendation = $this->recommendation
                        ->whereLike('name', $params['name']);

        return $this->recommendation->paginate(20);
    }
}