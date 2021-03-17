<?php

namespace App\Http\Controllers\BusModels;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\BusModelStoreRequest;

use App\Actions\BusModels\BusModelCreateOrUpdateAction;
use Session;

class BusModelCreateController extends Controller
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
    
    public function __invoke(BusModelStoreRequest $request)
    {
    	$model = $this->action->execute($request);
        Session::flash('success', 'Bus Model successfully created!');
        return redirect()->route('bus-model.show', $model->id);
    }
}
