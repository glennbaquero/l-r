<?php

namespace App\Actions\ExpenseIncomes;

use Illuminate\Support\Facades\DB;

use App\Models\ExpenseIncome;

class ExpenseIncomeCreateOrUpdateAction 
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
	 * Handles creating or updating of item
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$request['created_by'] = auth()->user()->id;
				$this->item = $this->item->create($request->all());
			} else {
				$this->item = ExpenseIncome::withTrashed()->findOrFail($id);
				$this->item->update($request->all());
			}
		DB::commit();

		return $this->item;
	}
}