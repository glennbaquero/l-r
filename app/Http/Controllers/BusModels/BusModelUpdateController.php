<?php

namespace App\Http\Controllers\BusModels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\BusModelStoreRequest;

use App\Actions\BusModels\BusModelCreateOrUpdateAction;
use Session;

class BusModelUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(BusModelCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(BusModelStoreRequest $request, $id)
    {
    	$model = $this->action->execute($request, $id);
        
        Session::flash('success', 'Bus model updated successfully!');

    	return redirect()->back();
    }
}
