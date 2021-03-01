<?php

namespace App\Actions\Drivers;

use Illuminate\Support\Facades\DB;

use App\Models\Driver;

class DriverCreateOrUpdateAction 
{
	protected $driver;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Driver $driver)
	{
		$this->driver = $driver;
	}

	/**
	 * Handles creating or updating of driver
	 */
	
	public function execute($request, $id = null)
	{
		$request['by_default'] = $request->filled('by_default');

		DB::beginTransaction();
			if(!$id) {
				$this->driver = $this->driver->create($request->all());
			} else {
				$this->driver = Driver::withTrashed()->findOrFail($id);
				$this->driver->update($request->all());
			}
		DB::commit();


		return $this->driver;
	}
}