<?php

namespace App\Actions\Currencies;

use Illuminate\Support\Facades\DB;

use App\Models\Currency;
use App\Models\CurrencyPrivilege;

class CurrencyCreateOrUpdateAction 
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
	 * Handles creating or updating of Currency
	 */
	
	public function execute($request, $id = null)
	{
		$request['default_currency'] = $request->filled('default_currency');

		DB::beginTransaction();
			if(!$id) {
				$this->currency = $this->currency->create($request->all());
			} else {
				$this->currency = Currency::withTrashed()->findOrFail($id);
				$this->currency->update($request->all());
			}
		DB::commit();

		return $this->currency;
	}
}