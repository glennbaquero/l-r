<?php

namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Cities\CityDeleteAction;

class CityDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CityDeleteAction $action)
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
    	$currency = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
