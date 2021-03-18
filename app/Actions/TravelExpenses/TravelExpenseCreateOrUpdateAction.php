<?php

namespace App\Actions\TravelExpenses;

use Illuminate\Support\Facades\DB;

use App\Models\Expense;

class TravelExpenseCreateOrUpdateAction 
{
	protected $expense;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Expense $expense)
	{
		$this->expense = $expense;
	}

	/**
	 * Handles creating or updating of expense
	 */
	
	public function execute($request, $id = null)
	{
		$request['is_currency_mex'] = $request->filled('is_currency_mex');

		DB::beginTransaction();
			if(!$id) {
				$this->expense = $this->expense->create($request->all());
			} else {
				$this->expense = Expense::withTrashed()->findOrFail($id);
				$this->expense->update($request->all());
			}
		DB::commit();


		return $this->expense;
	}
}