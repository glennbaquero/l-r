<?php

namespace App\Http\Controllers\Trips;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Trips\TripStoreRequest;

use App\Actions\Trips\TripCreateOrUpdateAction;
use Session;

class TripUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TripCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(TripStoreRequest $request, $id)
    {
    	$trip = $this->action->execute($request, $id);
        
        Session::flash('success', 'Trip updated successfully!');

    	return redirect()->back();
    }
}
