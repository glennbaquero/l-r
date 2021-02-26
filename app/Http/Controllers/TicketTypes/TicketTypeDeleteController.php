<?php

namespace App\Http\Controllers\TicketTypes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\TicketTypes\TicketTypeDeleteAction;

class TicketTypeDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TicketTypeDeleteAction $action)
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
    	$ticket_type = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
