<?php

namespace App\Actions\Trips;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\TripTime;

class TripCreateOrUpdateAction 
{
	protected $trip;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Trip $trip)
	{
		$this->trip = $trip;
	}

	/**
	 * Handles creating or updating of trip
	 */
	
	public function execute($request, $id = null)
	{
		$request['discounted_tickets'] = $request->filled('discounted_tickets');
		$request['show_on_web'] = $request->filled('show_on_web');
		$request['additional_receipt'] = $request->filled('additional_receipt');
		$request['express_trip'] = $request->filled('express_trip');

		DB::beginTransaction();
			if(!$id) {
				$this->trip = $this->trip->create($request->except(['driver_list', 'time_list']));

				foreach($request->time_list as $key => $time) {
					TripTime::create([
						'trip_id' => $this->trip->id,
						'time' => $time,
						'driver_id' => $request->driver_list[$key]
					]);
				}
				
			} else {
				$this->trip = Trip::withTrashed()->findOrFail($id);
				$this->trip->update($request->except(['new', 'driver_list', 'time_list', 'ids']));
				foreach($request->time_list as $key => $time) {
					if($request->new[$key] == 'true') {
						TripTime::create([
							'trip_id' => $this->trip->id,
							'time' => $time,
							'driver_id' => $request->driver_list[$key]
						]);	
					} else {
						$existing = TripTime::find($request->ids[$key]);

						$existing->update([
							'time' => $time,
							'driver_id' => $request->driver_list[$key]
						]);
					}
				}
			}
		DB::commit();


		return $this->trip;
	}
}