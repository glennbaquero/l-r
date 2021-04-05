<?php

namespace App\Http\Controllers\Tickets;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Offices\OfficeStoreRequest;

use App\Actions\Tickets\TicketCreateOrUpdateAction;
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
    	$office = $this->action->execute($request);

        return response()->json([
            'success' => true
        ]);
    }
}
