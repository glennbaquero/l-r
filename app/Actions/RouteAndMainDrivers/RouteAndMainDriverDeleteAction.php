<?php

namespace App\Actions\RouteAndMainDrivers;

use Illuminate\Support\Facades\DB;

use App\Models\RouteAndMainDriver;

class RouteAndMainDriverDeleteAction 
{
	protected $item;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(RouteAndMainDriver $item)
	{
		$this->item = $item;
	}

	/**
	 * Handles archiving of RouteAndMainDriver
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->item = RouteAndMainDriver::withTrashed()->findOrFail($id);
				$this->item->delete();
		DB::commit();


		return true;
	}
}