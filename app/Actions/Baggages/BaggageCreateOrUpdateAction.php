<?php

namespace App\Actions\Baggages;

use Illuminate\Support\Facades\DB;

use App\Models\Baggage;

class BaggageCreateOrUpdateAction 
{
	protected $baggage;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Baggage $baggage)
	{
		$this->baggage = $baggage;
	}

	/**
	 * Handles creating or updating of baggage
	 */
	
	public function execute($request, $id = null)
	{
		$request['received_amount'] = $request->filled('received_amount') ? $request->received_amount : 0;
		$request['return_cash'] = $request->filled('return_cash') ? $request->return_cash : 0;

		DB::beginTransaction();
			if(!$id) {
				$request['record_date'] = now();
				$request['user_id'] = auth()->user()->id;
				$this->baggage = $this->baggage->create($request->all());
			} else {
				$this->baggage = Baggage::withTrashed()->findOrFail($id);
				$this->baggage->update($request->all());
			}
		DB::commit();


		return $this->baggage;
	}
}