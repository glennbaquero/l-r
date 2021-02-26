<?php

namespace App\Http\Fetch;

use App\Models\TicketType;

class TicketTypeFetch
{
    protected $ticket_type;

    /**
     * Create new fetch instance
     * 
     * @return void
     */
    public function __construct(TicketType $ticket_type)
    {
        $this->ticket_type = $ticket_type;
    }

    /**
     * Handles querying of group model
     * 
     * @param array $params
     * @return mixed $ticket_type
     */
    public function execute($params)
    {
        $this->ticket_type = $this->ticket_type
                    ->whereLike('name', $params['name']);

        return $this->ticket_type->paginate(20);
    }
}