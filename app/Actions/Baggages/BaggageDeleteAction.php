<?php

namespace App\Actions\Baggages;

use Illuminate\Support\Facades\DB;

use App\Models\Baggage;

class BaggageDeleteAction 
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
	 * Handles archiving of Baggage
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->baggage = Baggage::withTrashed()->findOrFail($id);
				$this->baggage->delete();
		DB::commit();


		return true;
	}
}