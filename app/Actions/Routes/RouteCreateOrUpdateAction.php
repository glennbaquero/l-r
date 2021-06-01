<?php

namespace App\Actions\Routes;

use Illuminate\Support\Facades\DB;
use Illuminate\Validation\ValidationException;

use App\Models\Route;
use App\Models\Stop;

class RouteCreateOrUpdateAction 
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
	 * Handles creating or updating of Route
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$this->route = $this->route->create($request->except(['stops', 'division_point']));

				foreach (json_decode($request->stops) as $stop) {
					if (!$stop->departure_id) {
					    throw ValidationException::withMessages([
					        'departure_id' => ['The departure field is required for the stops.']
					    ]);
					}

					if (!$stop->arrival_id) {
					    throw ValidationException::withMessages([
					        'arrival_id' => ['The arrival field is required for the stops.']
					    ]);
					}

					if (!$stop->trip_length) {
						$stop->trip_length = '00:00:00';
					    // throw ValidationException::withMessages([
					    //     'trip_length' => ['The trip length field is required for the stops.']
					    // ]);
					}

					if (!$stop->wait_time) {
						$stop->wait_time = '00:00:00';
					    // throw ValidationException::withMessages([
					    //     'wait_time' => ['The wait time field is required for the stops.']
					    // ]);
					}

					Stop::create([
						'route_id' => $this->route->id,
						'trip_length' => $stop->trip_length,
						'wait_time' => $stop->wait_time,
						'distance' => $stop->distance,
						'arrival_id' => $stop->arrival_id,
						'departure_id' => $stop->departure_id,
						'division_point' => $stop->division_point,
						'show' => $stop->show,
					]);
				}
			} else {
				$this->route = Route::withTrashed()->findOrFail($id);
				$this->route->update($request->except(['stops', 'division_point']));

				foreach (json_decode($request->stops) as $stop) {

					if (!$stop->departure_id) {
					    throw ValidationException::withMessages([
					        'departure_id' => ['The departure field is required for the stops.']
					    ]);
					}

					if (!$stop->arrival_id) {
					    throw ValidationException::withMessages([
					        'arrival_id' => ['The arrival field is required for the stops.']
					    ]);
					}

					if (!$stop->trip_length) {
						$stop->trip_length = '00:00:00';
					    // throw ValidationException::withMessages([
					    //     'trip_length' => ['The trip length field is required for the stops.']
					    // ]);
					}

					if (!$stop->wait_time) {
						$stop->wait_time = '00:00:00';
					    // throw ValidationException::withMessages([
					    //     'wait_time' => ['The wait time field is required for the stops.']
					    // ]);
					}
					
					if(isset($stop->new)) {
						Stop::create([
							'route_id' => $this->route->id,
							'trip_length' => $stop->trip_length,
							'wait_time' => $stop->wait_time,
							'distance' => $stop->distance,
							'arrival_id' => $stop->arrival_id,
							'departure_id' => $stop->departure_id,
							'division_point' => $stop->division_point,
							'show' => $stop->show,
						]);
					} else {
						$existing_stop = Stop::withTrashed()->findOrFail($stop->id);
						$existing_stop->update([
							'deleted_at' => $stop->deleted_at,
							'trip_length' => $stop->trip_length,
							'wait_time' => $stop->wait_time,
							'distance' => $stop->distance,
							'arrival_id' => $stop->arrival_id,
							'departure_id' => $stop->departure_id,
							'division_point' => $stop->division_point,
							'show' => $stop->show,
						]);
					}
				}
			}

		DB::commit();

		return $this->route;
	}
}