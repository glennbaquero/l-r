<?php

namespace App\Http\Controllers\TicketTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TicketTypes\TicketTypeStoreRequest;

use App\Actions\TicketTypes\TicketTypeCreateOrUpdateAction;
use Session;

class TicketTypeUpdateController extends Controller
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
    
    public function __invoke(TicketTypeStoreRequest $request, $id)
    {
    	$ticket_type = $this->action->execute($request, $id);
        
        Session::flash('success', 'Ticket type updated successfully!');

    	return redirect()->back();
    }
}
