<?php

namespace App\Actions\AccountPayables;

use Illuminate\Support\Facades\DB;

use App\Models\AccountPayable;

class AccountPayableCreateOrUpdateAction 
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
	 * Handles creating or updating of account payable
	 */
	
	public function execute($request, $id = null)
	{

		DB::beginTransaction();
			if(!$id) {
				$this->item = $this->item->create($request->all());
			} else {
				$this->item = AccountPayable::withTrashed()->findOrFail($id);
				$this->item->update($request->all());
			}
		DB::commit();


		return $this->item;
	}
}