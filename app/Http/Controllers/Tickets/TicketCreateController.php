<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Offices\OfficeStoreRequest;

use App\Actions\Tickets\TicketCreateOrUpdateAction;
use App\Notifications\TicketNotifyPassenger;
use Session;

class TicketCreateController extends Controller
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
    
    public function __invoke(Request $request)
    {
    	$ticket = $this->action->execute($request);

        $route = route('ticket.print', [$ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name]);

        $ticket->passenger->notify(new TicketNotifyPassenger('Your reservation is confirmed, you can download here the copy of your ticket.', $route));

        if($request->action === 'Yes') {
            return response()->json([
                'print_url' => route('ticket.print', [$ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name])
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }
}
