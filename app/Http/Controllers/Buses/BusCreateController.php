<?php

namespace App\Http\Controllers\Buses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\BusStoreRequest;

use App\Actions\Buses\BusCreateOrUpdateAction;
use Session;

class BusCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(BusCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(BusStoreRequest $request)
    {
    	$bus = $this->action->execute($request);
        Session::flash('success', 'Bus successfully created!');
        return redirect()->route('bus.show', $bus->id);
    }
}
