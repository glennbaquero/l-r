<?php

namespace App\Actions\Prices;

use Illuminate\Support\Facades\DB;

use App\Models\Price;

class PriceCreateOrUpdateAction 
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
	 * Handles creating or updating of Price
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->price = $this->price->create($request->all());

			} else {
				$this->price = Price::withTrashed()->findOrFail($id);
				$this->price->update($request->all());
			}
		DB::commit();

		return $this->price;
	}
}