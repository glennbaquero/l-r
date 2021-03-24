<?php

namespace App\Http\Controllers\Baggages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Baggages\BaggageStoreRequest;

use App\Actions\Baggages\BaggageCreateOrUpdateAction;
use Session;

class BaggageUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(BaggageCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(BaggageStoreRequest $request, $id)
    {
    	$baggage = $this->action->execute($request, $id);
        
        Session::flash('success', 'Baggage updated successfully!');

    	return redirect()->back();
    }
}
