<?php

namespace App\Actions\Routes;

use Illuminate\Support\Facades\DB;

use App\Models\Route;

class RouteDeleteAction 
{
	protected $route;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Route $route)
	{
		$this->route = $route;
	}

	/**
	 * Handles archiving of Route
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->route = Route::withTrashed()->findOrFail($id);
				$this->route->delete();
		DB::commit();


		return true;
	}
}