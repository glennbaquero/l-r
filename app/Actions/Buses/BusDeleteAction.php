<?php

namespace App\Actions\Buses;

use Illuminate\Support\Facades\DB;

use App\Models\Bus;

class BusDeleteAction 
{
	protected $bus;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Bus $bus)
	{
		$this->bus = $bus;
	}

	/**
	 * Handles archiving of bus bus
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->bus = Bus::withTrashed()->findOrFail($id);
				$this->bus->delete();
		DB::commit();


		return true;
	}
}