<?php

namespace App\Http\Fetch;

use App\Models\Cell;

class CellFetch
{
    protected $cell;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Cell $cell)
    {
        $this->cell = $cell;
    }

    /**
     * Handles querying of service model
     * 
     * @param array $params
     * @return mixed $cell
     */
    public function execute($params)
    {
        $this->cell = $this->cell
                    ->whereLike('name', $params['name'])
                    ->orWhereLike('icon', $params['icon']);

        return $this->cell->paginate(20);
    }
}