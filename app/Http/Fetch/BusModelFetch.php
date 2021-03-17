<?php

namespace App\Http\Fetch;

use App\Models\BusModel;

class BusModelFetch
{
    protected $model;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(BusModel $model)
    {
        $this->model = $model;
    }

    /**
     * Handles querying of service model
     * 
     * @param array $params
     * @return mixed $model
     */
    public function execute($params)
    {
        $this->model = $this->model
                    ->whereLike('name', $params['name'])
                    ->orWhereLike('rows', $params['rows'])
                    ->orWhereLike('columns', $params['columns'])
                    ->orWhereLike('floors', $params['floors']);

        return $this->model->paginate(20);
    }
}