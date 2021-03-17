<?php

namespace App\Http\Controllers\Buses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\BusStoreRequest;

use App\Actions\Buses\BusCreateOrUpdateAction;
use Session;

class BusUpdateController extends Controller
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
    
    public function __invoke(BusStoreRequest $request, $id)
    {
    	$bus = $this->action->execute($request, $id);
        
        Session::flash('success', 'Bus updated successfully!');

    	return redirect()->back();
    }
}
