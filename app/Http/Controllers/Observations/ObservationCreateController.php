<?php

namespace App\Http\Controllers\Observations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Buses\ObservationStoreRequest;

use App\Actions\Observations\ObservationCreateOrUpdateAction;
use Session;

class ObservationCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(ObservationCreateOrUpdateAction $action)
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
    	$model = $this->action->execute($request);
        Session::flash('success', 'Observation successfully created!');
        return back();
    }
}
