<?php

namespace App\Http\Controllers\RouteAndMainDrivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\RouteAndMainDrivers\RouteAndMainDriverDeleteAction;

class RouteAndMainDriverDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RouteAndMainDriverDeleteAction $action)
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
    	$item = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
