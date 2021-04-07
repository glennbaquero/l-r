<?php

namespace App\Actions\ExpenseIncomes;

use Illuminate\Support\Facades\DB;

use App\Models\ExpenseIncome;

class ExpenseIncomeDeleteAction 
{
	protected $item;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(ExpenseIncome $item)
	{
		$this->item = $item;
	}

	/**
	 * Handles archiving of ExpenseIncome
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->item = ExpenseIncome::withTrashed()->findOrFail($id);
				$this->item->delete();
		DB::commit();


		return true;
	}
}