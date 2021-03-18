<?php

namespace App\Actions\TravelExpenses;

use Illuminate\Support\Facades\DB;

use App\Models\Expense;

class TravelExpenseDeleteAction 
{
	protected $expense;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(TravelExpense $expense)
	{
		$this->expense = $expense;
	}

	/**
	 * Handles archiving of expense
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->expense = Expense::withTrashed()->findOrFail($id);
				$this->expense->delete();
		DB::commit();


		return true;
	}
}