<?php

namespace App\Actions\DiscountOptions;

use Illuminate\Support\Facades\DB;

use App\Models\DiscountIncreaseOption;

class DiscountOptionCreateOrUpdateAction 
{
	protected $option;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(DiscountIncreaseOption $option)
	{
		$this->option = $option;
	}

	/**
	 * Handles creating or updating of DiscountIncreaseOption
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$request['created_by'] = auth()->user()->id;
				$this->option = $this->option->create($request->all());
			} else {
				$request['updated_by'] = auth()->user()->id;
				$this->option = DiscountIncreaseOption::withTrashed()->findOrFail($id);
				$this->option->update($request->all());
			}
		DB::commit();

		return $this->option;
	}
}