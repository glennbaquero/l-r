<?php

namespace App\Actions\Trips;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;

class TripDeleteAction 
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
	 * Handles archiving of trip
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->trip = Trip::withTrashed()->findOrFail($id);
				$this->trip->delete();
		DB::commit();


		return true;
	}
}