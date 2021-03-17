<?php

namespace App\Http\Fetch;

use App\Models\Bus;
use App\Models\BusModel;

class BusFetch
{
    protected $bus;
    protected $model;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Bus $bus, BusModel $model)
    {
        $this->bus = $bus;
        $this->model = $model;
    }

    /**
     * Handles querying of bus
     * 
     * @param array $params
     * @return mixed $bus
     */
    public function execute($params)
    {
        $this->bus = $this->bus
                    ->whereLike('name', $params['name'])
                    ->orWhereLike('plate', $params['plate']);

        if($params['model'] && $params['model'] != 'null') {
            $modelId = $this->model->whereLike('name', $params['model'])->pluck('id')->toArray();
            $this->bus = $this->bus->whereIn('bus_model_id', $modelId);
        }

        return $this->bus->paginate(20);
    }
}