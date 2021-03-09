<?php

namespace App\Http\Controllers\Routes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Routes\RouteDeleteAction;

class RouteDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RouteDeleteAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $id)
    {
    	$route = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
