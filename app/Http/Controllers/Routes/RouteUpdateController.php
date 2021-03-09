<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Routes\RouteStoreRequest;

use App\Actions\Routes\RouteCreateOrUpdateAction;
use Session;

class RouteUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RouteCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(RouteStoreRequest $request, $id)
    {
    	$route = $this->action->execute($request, $id);
        
        Session::flash('success', 'Route updated successfully!');

    	return redirect()->back();
    }
}
