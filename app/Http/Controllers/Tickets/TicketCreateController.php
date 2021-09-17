<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Offices\OfficeStoreRequest;

use App\Actions\Tickets\TicketCreateOrUpdateAction;
use App\Notifications\TicketNotifyPassenger;
use App\Notifications\PassengerPaymentFormNotification;
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

        if($request->payment_method != 'Cash') {
            $route = route('ticket.print', [$ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name, true]);
        }

        if($request->action === 'Print and email') {
            $ticket->passenger->notify(new TicketConfirmationNotification($ticket));

            return response()->json([
                'print_url' => $route
            ]);
        } 

        if($request->action === 'Print only') {
            return response()->json([
                'print_url' => $route
            ]);
        } 

        if($request->action === 'Confirmation only') {
            $ticket->passenger->notify(new TicketConfirmationNotification($ticket));
        }

        // $ticket->passenger->notify(new PassengerPaymentFormNotification($ticket));

        return response()->json([
            'success' => true
        ]);
    }
}
