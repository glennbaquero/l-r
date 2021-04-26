<?php

namespace App\Http\Controllers\ExpenseIncomes;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\ExpenseIncomes\ExpenseIncomeDeleteAction;

class ExpenseIncomeDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(ExpenseIncomeDeleteAction $action)
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
    	$voucher = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
