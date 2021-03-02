<?php

namespace App\Http\Fetch;

use App\Models\ConfigurationTerminal;

class TerminalFetch
{
    protected $terminal;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(ConfigurationTerminal $terminal)
    {
        $this->terminal = $terminal;
    }

    /**
     * Handles querying of terminal model
     * 
     * @param array $params
     * @return mixed $terminal
     */
    public function execute($params)
    {
        $this->terminal = $this->terminal->whereHas('office', function($q) use($params) {
                $q->whereLike('name', $params['office']);
        });
                            // ->whereLike('office.name', $params['office']);

        return $this->terminal->paginate(20);
    }
}