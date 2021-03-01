<?php

namespace App\Actions\Drivers;

use Illuminate\Support\Facades\DB;

use App\Models\Driver;

class DriverDeleteAction 
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
	 * Handles archiving of Driver
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->driver = Driver::withTrashed()->findOrFail($id);
				$this->driver->delete();
		DB::commit();


		return true;
	}
}