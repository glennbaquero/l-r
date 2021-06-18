<?php

namespace App\Actions\AccountPayables;

use Illuminate\Support\Facades\DB;

use App\Models\AccountPayable;

class AccountPayableDeleteAction 
{
	protected $item;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(AccountPayable $item)
	{
		$this->item = $item;
	}

	/**
	 * Handles archiving of AccountPayable
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->item = AccountPayable::withTrashed()->findOrFail($id);
				$this->item->delete();
		DB::commit();


		return true;
	}
}