<?php

namespace App\Http\Controllers\InterlinePrices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\InterlinePrices\InterlinePriceDeleteAction;

class InterlinePriceDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(InterlinePriceDeleteAction $action)
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
