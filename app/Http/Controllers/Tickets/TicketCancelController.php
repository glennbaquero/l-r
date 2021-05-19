<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Offices\OfficeStoreRequest;

use App\Actions\Tickets\TicketCreateOrUpdateAction;
use App\Notifications\TicketNotifyPassenger;
use Session;

class TicketCancelController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TicketCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $id)
    {
    	$ticket = $this->action->execute($request, $id);

        $ticket->passenger->notify(new TicketNotifyPassenger('sample text'));

        return redirect()->back();
    }
}
