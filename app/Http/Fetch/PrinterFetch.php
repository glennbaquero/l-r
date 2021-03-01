<?php

namespace App\Http\Fetch;

use App\Models\Printer;

class PrinterFetch
{
    protected $printer;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(Printer $printer)
    {
        $this->printer = $printer;
    }

    /**
     * Handles querying of printer model
     * 
     * @param array $params
     * @return mixed $printer
     */
    public function execute($params)
    {
        $this->printer = $this->printer
                    ->whereLike('name', $params['name'])
                    ->orWhereLike('code', $params['code']);


        return $this->printer->paginate(20);
    }
}