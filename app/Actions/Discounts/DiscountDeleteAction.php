<?php

namespace App\Actions\Discounts;

use Illuminate\Support\Facades\DB;

use App\Models\Discount;

class DiscountDeleteAction 
{
	protected $discount;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Discount $discount)
	{
		$this->discount = $discount;
	}

	/**
	 * Handles archiving of discount
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->discount = Discount::withTrashed()->findOrFail($id);
				$this->discount->delete();
		DB::commit();


		return true;
	}
}