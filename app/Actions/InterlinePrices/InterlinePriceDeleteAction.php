<?php

namespace App\Actions\InterlinePrices;

use Illuminate\Support\Facades\DB;

use App\Models\InterlinePrice;

class InterlinePriceDeleteAction 
{
	protected $price;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(InterlinePrice $price)
	{
		$this->price = $price;
	}

	/**
	 * Handles archiving of Interline
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->price = InterlinePrice::withTrashed()->findOrFail($id);
				$this->price->delete();
		DB::commit();


		return true;
	}
}