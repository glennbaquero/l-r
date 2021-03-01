<?php

namespace App\Actions\Currencies;

use Illuminate\Support\Facades\DB;

use App\Models\Currency;

class CurrencyDeleteAction 
{
	protected $currency;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Currency $currency)
	{
		$this->currency = $currency;
	}

	/**
	 * Handles archiving of Currency
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->currency = Currency::withTrashed()->findOrFail($id);
				$this->currency->delete();
		DB::commit();


		return true;
	}
}