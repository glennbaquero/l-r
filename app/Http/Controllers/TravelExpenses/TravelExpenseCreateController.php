<?php

namespace App\Http\Controllers\TravelExpenses;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\TravelExpenses\TravelExpenseStoreRequest;

use App\Actions\TravelExpenses\TravelExpenseCreateOrUpdateAction;
use Session;

class TravelExpenseCreateController extends Controller
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
    
    public function __invoke(TravelExpenseStoreRequest $request)
    {
    	$travel = $this->action->execute($request);
        Session::flash('success', 'Travel Expense successfully created!');
        // return redirect()->route('travel-expense.show', $travel->id);
        return redirect()->back();
    }
}
