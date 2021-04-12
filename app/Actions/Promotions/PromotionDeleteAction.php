<?php

namespace App\Actions\Promotions;

use Illuminate\Support\Facades\DB;

use App\Models\Promotion;

class PromotionDeleteAction 
{
	protected $promotion;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Promotion $promotion)
	{
		$this->promotion = $promotion;
	}

	/**
	 * Handles archiving of Promotion
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->promotion = Promotion::withTrashed()->findOrFail($id);
				$this->promotion->delete();
		DB::commit();


		return true;
	}
}