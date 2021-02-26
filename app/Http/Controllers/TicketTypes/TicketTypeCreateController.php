<?php

namespace App\Http\Controllers\TicketTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TicketTypes\TicketTypeStoreRequest;

use App\Actions\TicketTypes\TicketTypeCreateOrUpdateAction;
use Session;

class TicketTypeCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TicketTypeCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(TicketTypeStoreRequest $request)
    {
    	$ticket_type = $this->action->execute($request);
        Session::flash('success', 'Ticket type successfully created!');
        return redirect()->route('ticket-type.show', $ticket_type->id);
    }
}
