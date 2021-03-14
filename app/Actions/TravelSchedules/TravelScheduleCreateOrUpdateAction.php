<?php

namespace App\Actions\TravelSchedules;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;
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
		$request['discounted_tickets'] = $request->filled('discounted_tickets');
		$request['show_on_web'] = $request->filled('show_on_web');
		$request['additional_receipt'] = $request->filled('additional_receipt');
		$request['express_trip'] = $request->filled('express_trip');

		$period = CarbonPeriod::create($request->start_date, $request->end_date);

		foreach ($period as $date) {
			$request['date'] = $date->format('Y-m-d');

			switch ($date->format('l')) {
				case 'Monday':
					$request['time'] = $request->filled('monday') ? Carbon::parse($request->monday_time) : null;
					if($request->filled('monday')) {
						$this->run($request, $id);
					}
					break;
				case 'Tuesday':
					$request['time'] = $request->filled('tuesday') ? Carbon::parse($request->tuesday_time) : null;
					if($request->filled('tuesday')) {
						$this->run($request, $id);
					}
					break;
				case 'Wednesday':
					$request['time'] = $request->filled('wednesday') ? Carbon::parse($request->wednesday_time) : null;
					if($request->filled('wednesday')) {
						$this->run($request, $id);
					}
					break;
				case 'Thursday':
					$request['time'] = $request->filled('thursday') ? Carbon::parse($request->thursday_time) : null;
					if($request->filled('thursday')) {
						$this->run($request, $id);
					}
					break;
				case 'Friday':
					$request['time'] = $request->filled('friday') ? Carbon::parse($request->friday_time) : null;
					if($request->filled('friday')) {
						$this->run($request, $id);
					}
					break;
				case 'Saturday':
					$request['time'] = $request->filled('saturday') ? Carbon::parse($request->saturday_time) : null;
					if($request->filled('saturday')) {
						$this->run($request, $id);
					}
					break;
				case 'Sunday':
					$request['time'] = $request->filled('sunday') ? Carbon::parse($request->sunday_time) : null;
					if($request->filled('sunday')) {
						$this->run($request, $id);
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
				$this->trip = $this->trip->create($request->except(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'monday_time', 'tuesday_time', 'wednesday_time', 'thursday_time', 'friday_time', 'saturday_time', 'sunday_time', 'start_date', 'end_date']));
			} else {
				$this->trip = Trip::withTrashed()->findOrFail($id);
				$this->trip->update($request->except(['monday', 'tuesday', 'wednesday', 'thursday', 'friday', 'saturday', 'sunday', 'monday_time', 'tuesday_time', 'wednesday_time', 'thursday_time', 'friday_time', 'saturday_time', 'sunday_time', 'start_date', 'end_date']));
			}
		DB::commit();
	}
}