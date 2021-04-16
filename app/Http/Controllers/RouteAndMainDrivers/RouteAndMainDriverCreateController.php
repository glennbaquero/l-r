<?php

namespace App\Http\Controllers\RouteAndMainDrivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\RouteMainDrivers\RouteMainDriverStoreRequest;

use App\Actions\RouteAndMainDrivers\RouteAndMainDriverCreateOrUpdateAction;
use Session;

class RouteAndMainDriverCreateController extends Controller
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
    
    public function __invoke(RouteMainDriverStoreRequest $request)
    {
    	$item = $this->action->execute($request);
        Session::flash('success', 'Route and main driver successfully created!');
        return redirect()->route('route-main-driver.show', $item->id);
    }
}
