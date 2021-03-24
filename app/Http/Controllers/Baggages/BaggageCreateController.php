<?php

namespace App\Http\Controllers\Baggages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Baggages\BaggageStoreRequest;

use App\Actions\Baggages\BaggageCreateOrUpdateAction;
use Session;

class BaggageCreateController extends Controller
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
    
    public function __invoke(BaggageStoreRequest $request)
    {
    	$baggage = $this->action->execute($request);
        Session::flash('success', 'Baggage successfully created!');
        return redirect()->route('baggage.show', $baggage->id);
    }
}
