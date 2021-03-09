<?php

namespace App\Http\Controllers\MultiRoutes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Routes\MultiRouteStoreRequest;

use App\Actions\MultiRoutes\MultiRouteCreateOrUpdateAction;
use Session;

class MultiRouteCreateController extends Controller
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
    
    public function __invoke(MultiRouteStoreRequest $request)
    {
    	$route = $this->action->execute($request);
        Session::flash('success', 'Multi Route successfully created!');
        return redirect()->route('multi-route.show', $route->id);
    }
}
