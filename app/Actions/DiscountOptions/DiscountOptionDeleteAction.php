<?php

namespace App\Actions\DiscountOptions;

use Illuminate\Support\Facades\DB;

use App\Models\DiscountIncreaseOption;

class DiscountOptionDeleteAction 
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
	 * Handles archiving of DiscountIncreaseOption
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->option = DiscountIncreaseOption::withTrashed()->findOrFail($id);
				$this->option->delete();
		DB::commit();


		return true;
	}
}