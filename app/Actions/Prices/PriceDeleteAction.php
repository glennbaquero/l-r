<?php

namespace App\Actions\Prices;

use Illuminate\Support\Facades\DB;

use App\Models\Price;

class PriceDeleteAction 
{
	protected $price;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Price $price)
	{
		$this->price = $price;
	}

	/**
	 * Handles archiving of Price
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->price = Price::withTrashed()->findOrFail($id);
				$this->price->delete();
		DB::commit();


		return true;
	}
}