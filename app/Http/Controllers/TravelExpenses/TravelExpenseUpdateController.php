<?php

namespace App\Http\Controllers\TravelExpenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TravelExpenses\TravelExpenseStoreRequest;

use App\Actions\TravelExpenses\TravelExpenseCreateOrUpdateAction;
use Session;

class TravelExpenseUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TravelExpenseCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(TravelExpenseStoreRequest $request, $id)
    {
    	$trip = $this->action->execute($request, $id);
        
        Session::flash('success', 'Travel Expense updated successfully!');

    	return redirect()->back();
    }
}
