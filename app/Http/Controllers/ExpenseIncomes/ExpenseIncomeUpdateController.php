<?php

namespace App\Http\Controllers\ExpenseIncomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ExpenseIncomes\ExpenseIncomeStoreRequest;

use App\Actions\ExpenseIncomes\ExpenseIncomeCreateOrUpdateAction;
use Session;

class ExpenseIncomeUpdateController extends Controller
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
    
    public function __invoke(ExpenseIncomeStoreRequest $request, $id)
    {
    	$item = $this->action->execute($request, $id);
        
        Session::flash('success', 'Voucher updated successfully!');

    	return redirect()->back();
    }
}
