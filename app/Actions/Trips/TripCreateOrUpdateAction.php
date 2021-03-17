<?php

namespace App\Actions\Trips;

use Illuminate\Support\Facades\DB;

use App\Models\Trip;

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
				$this->trip = $this->trip->create($request->all());
			} else {
				$this->trip = Trip::withTrashed()->findOrFail($id);
				$this->trip->update($request->all());
			}
		DB::commit();


		return $this->trip;
	}
}