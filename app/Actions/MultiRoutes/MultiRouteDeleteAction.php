<?php

namespace App\Actions\MultiRoutes;

use Illuminate\Support\Facades\DB;

use App\Models\MultiRoute;

class MultiRouteDeleteAction 
{
	protected $route;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(MultiRoute $route)
	{
		$this->route = $route;
	}

	/**
	 * Handles archiving of Route
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->route = MultiRoute::withTrashed()->findOrFail($id);
				$this->route->delete();
		DB::commit();


		return true;
	}
}