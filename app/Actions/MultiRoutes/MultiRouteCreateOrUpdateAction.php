<?php

namespace App\Actions\MultiRoutes;

use Illuminate\Support\Facades\DB;

use App\Models\MultiRoute;
use App\Models\MultiRouteStop;

class MultiRouteCreateOrUpdateAction 
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
	 * Handles creating or updating of MultiRoute
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->route = $this->route->create($request->except(['stops']));

				foreach (json_decode($request->stops) as $stop) {
					MultiRouteStop::create([
						'multi_route_id' => $this->route->id,
						'arrival_id' => $stop->arrival_id,
						'departure_id' => $stop->departure_id,
						'route_id' => $stop->route_id,
						'auto' => $stop->auto,
					]);
				}
			} else {
				$this->route = MultiRoute::withTrashed()->findOrFail($id);
				$this->route->update($request->except(['stops']));

				foreach (json_decode($request->stops) as $stop) {
					if(isset($stop->new)) {
						MultiRouteStop::create([
							'multi_route_id' => $this->route->id,
							'arrival_id' => $stop->arrival_id,
							'departure_id' => $stop->departure_id,
							'route_id' => $stop->route_id,
							'auto' => $stop->auto,
						]);
					} else {
						$existing_stop = MultiRouteStop::withTrashed()->findOrFail($stop->id);
						$existing_stop->update([
							'deleted_at' => $stop->deleted_at,
							'arrival_id' => $stop->arrival_id,
							'departure_id' => $stop->departure_id,
							'route_id' => $stop->route_id,
							'auto' => $stop->auto,
						]);
					}
				}
			}

		DB::commit();

		return $this->route;
	}
}