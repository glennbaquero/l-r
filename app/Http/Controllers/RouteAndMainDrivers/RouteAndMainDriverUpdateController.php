<?php

namespace App\Http\Controllers\RouteAndMainDrivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RouteMainDrivers\RouteMainDriverStoreRequest;

use App\Actions\RouteAndMainDrivers\RouteAndMainDriverCreateOrUpdateAction;
use Session;

class RouteAndMainDriverUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RouteAndMainDriverCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(RouteMainDriverStoreRequest $request, $id)
    {
    	$item = $this->action->execute($request, $id);
        
        Session::flash('success', 'Route and main driver updated successfully!');

    	return redirect()->back();
    }
}
