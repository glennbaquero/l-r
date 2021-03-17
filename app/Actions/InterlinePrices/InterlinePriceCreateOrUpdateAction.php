<?php

namespace App\Actions\InterlinePrices;

use Illuminate\Support\Facades\DB;

use App\Models\InterlinePrice;

class InterlinePriceCreateOrUpdateAction 
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
	 * Handles creating or updating of Interline
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->price = $this->price->create($request->all());

			} else {
				$this->price = InterlinePrice::withTrashed()->findOrFail($id);
				$this->price->update($request->all());
			}
		DB::commit();

		return $this->price;
	}
}