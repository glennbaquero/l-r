<?php

namespace App\Http\Controllers\TravelExpenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\TravelExpenses\TravelExpenseDeleteAction;

class TravelExpenseDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TravelExpenseDeleteAction $action)
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
    	$user = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
