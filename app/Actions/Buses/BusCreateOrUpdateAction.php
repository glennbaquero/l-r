<?php

namespace App\Actions\Buses;

use Illuminate\Support\Facades\DB;

use App\Models\Bus;

class BusCreateOrUpdateAction 
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
	 * Handles creating or updating of Bus
	 */
	
	public function execute($request, $id = null)
	{
		$request['first_floor_to_show'] = $request->filled('first_floor_to_show');
		$request['default_bus'] = $request->filled('default_bus');
		DB::beginTransaction();
			if(!$id) {
				$this->bus = $this->bus->create($request->all());
			} else {
				$this->bus = Bus::withTrashed()->findOrFail($id);
				$this->bus->update($request->all());

			}
		DB::commit();


		return $this->bus;
	}
}