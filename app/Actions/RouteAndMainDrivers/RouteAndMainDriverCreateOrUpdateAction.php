<?php

namespace App\Actions\RouteAndMainDrivers;

use Illuminate\Support\Facades\DB;

use App\Models\RouteAndMainDriver;

class RouteAndMainDriverCreateOrUpdateAction 
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
	 * Handles creating or updating of item
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->item = $this->item->create($request->all());
			} else {
				$this->item = RouteAndMainDriver::withTrashed()->findOrFail($id);
				$this->item->update($request->all());
			}
		DB::commit();

		return $this->item;
	}
}