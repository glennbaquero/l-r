<?php

namespace App\Http\Controllers\ExpenseIncomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseIncomes\ExpenseIncomeStoreRequest;

use App\Actions\ExpenseIncomes\ExpenseIncomeCreateOrUpdateAction;
use Session;

class ExpenseIncomeCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(ExpenseIncomeCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(ExpenseIncomeStoreRequest $request)
    {
    	$item = $this->action->execute($request);
        Session::flash('success', 'Expense/Income successfully created!');
        return redirect()->route('expense-income.show', $item->id);
    }
}
