<?php

namespace App\Actions\TravelSchedules;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
use App\Models\TripTime;
use Carbon\CarbonPeriod;
use Carbon\Carbon;

class TravelScheduleCreateOrUpdateAction 
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
		// dd($request->all());
		$request['discounted_tickets'] = $request->filled('discounted_tickets');
		$request['show_on_web'] = $request->filled('show_on_web');
		$request['additional_receipt'] = $request->filled('additional_receipt');
		$request['express_trip'] = $request->filled('express_trip');

		$period = CarbonPeriod::create($request->start_date, $request->end_date);

		foreach ($period as $date) {
			$request['date'] = $date->format('Y-m-d');

			switch ($date->format('l')) {
				case 'Monday':
					// $request['time'] = $request->filled('monday') ? Carbon::parse($request->monday_time) : null;
					if($request->filled('monday')) {
						$this->run($request, $id);

						foreach($request->monday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->monday_time_driver[$key],
								'bus_id' => $request->monday_time_bus[$key],
								'arrival_time' => $request->monday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Tuesday':
					// $request['time'] = $request->filled('tuesday') ? Carbon::parse($request->tuesday_time) : null;
					if($request->filled('tuesday')) {
						$this->run($request, $id);

						foreach($request->tuesday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->tuesday_time_driver[$key],
								'bus_id' => $request->tuesday_time_bus[$key],
								'arrival_time' => $request->tuesday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Wednesday':
					// $request['time'] = $request->filled('wednesday') ? Carbon::parse($request->wednesday_time) : null;
					if($request->filled('wednesday')) {
						$this->run($request, $id);

						foreach($request->wednesday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->wednesday_time_driver[$key],
								'bus_id' => $request->wednesday_time_bus[$key],
								'arrival_time' => $request->wednesday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Thursday':
					if($request->filled('thursday')) {
						$this->run($request, $id);

						foreach($request->thursday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->thursday_time_driver[$key],
								'thursday_id' => $request->thursday_time_thursday[$key],
								'arrival_time' => $request->thursday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Friday':
					// $request['time'] = $request->filled('friday') ? Carbon::parse($request->friday_time) : null;
					if($request->filled('friday')) {
						$this->run($request, $id);

						foreach($request->friday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->friday_time_driver[$key],
								'bus_id' => $request->friday_time_bus[$key],
								'arrival_time' => $request->friday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Saturday':
					// $request['time'] = $request->filled('saturday') ? Carbon::parse($request->saturday_time) : null;
					if($request->filled('saturday')) {
						$this->run($request, $id);

						foreach($request->saturday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->saturday_time_driver[$key],
								'bus_id' => $request->saturday_time_bus[$key],
								'arrival_time' => $request->saturday_arrival_time[$key],
							]);
						}
					}
					break;
				case 'Sunday':
					// $request['time'] = $request->filled('sunday') ? Carbon::parse($request->sunday_time) : null;
					if($request->filled('sunday')) {
						$this->run($request, $id);

						foreach($request->sunday_time as $key => $time) {
							$time = Carbon::parse($time);
							TripTime::create([
								'trip_id' => $this->trip->id,
								'time' => $time,
								'driver_id' => $request->sunday_time_driver[$key],
								'bus_id' => $request->sunday_time_bus[$key],
								'arrival_time' => $request->sunday_arrival_time[$key],
							]);
						}
					}
					break;
			}
		}

		return $this->trip;
	}

	/**
	 * Store or update the data when the logic is true
	 */

	public function run($request, $id = null)
	{

		DB::beginTransaction();
			if(!$id) {
				$this->trip = $this->trip->create($request->except(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'monday_time', 'tuesday_time', 'wednesday_time', 'thursday_time', 'friday_time', 'saturday_time', 'sunday_time', 'start_date', 'end_date', 'monday_time_driver', 'tuesday_time_driver', 'wednesday_time_driver', 'thursday_time_driver', 'friday_time_driver', 'saturday_time_driver', 'sunday_time_driver', 'monday_time_bus', 'tuesday_time_bus', 'wednesday_time_bus', 'thursday_time_bus', 'friday_time_bus', 'saturday_time_bus', 'sunday_time_bus', 'monday_arrival_time', 'tuesday_arrival_time', 'wednesday_arrival_time', 'thursday_arrival_time', 'friday_arrival_time', 'saturday_arrival_time', 'sunday_arrival_time']));
			} else {
				$this->trip = Trip::withTrashed()->findOrFail($id);
				$this->trip->update($request->except(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'monday_time', 'tuesday_time', 'wednesday_time', 'thursday_time', 'friday_time', 'saturday_time', 'sunday_time', 'start_date', 'end_date', 'monday_time_driver', 'tuesday_time_driver', 'wednesday_time_driver', 'thursday_time_driver', 'friday_time_driver', 'saturday_time_driver', 'sunday_time_driver', 'monday_time_bus', 'tuesday_time_bus', 'wednesday_time_bus', 'thursday_time_bus', 'friday_time_bus', 'saturday_time_bus', 'sunday_time_bus', 'monday_arrival_time', 'tuesday_arrival_time', 'wednesday_arrival_time', 'thursday_arrival_time', 'friday_arrival_time', 'saturday_arrival_time', 'sunday_arrival_time']));
			}
		DB::commit();
	}
}