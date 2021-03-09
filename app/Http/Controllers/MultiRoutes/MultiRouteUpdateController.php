<?php

namespace App\Http\Controllers\MultiRoutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Routes\MultiRouteStoreRequest;

use App\Actions\MultiRoutes\MultiRouteCreateOrUpdateAction;
use Session;

class MultiRouteUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(MultiRouteCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(MultiRouteStoreRequest $request, $id)
    {
    	$route = $this->action->execute($request, $id);
        
        Session::flash('success', 'Multi Route updated successfully!');

    	return redirect()->back();
    }
}
