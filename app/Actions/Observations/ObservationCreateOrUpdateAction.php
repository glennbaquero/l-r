<?php

namespace App\Actions\Observations;

use Illuminate\Support\Facades\DB;
use App\Notifications\ObservationNotifyPassenger;

use App\Models\Observation;

class ObservationCreateOrUpdateAction 
{
	protected $observation;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Observation $observation)
	{
		$this->observation = $observation;
	}

	/**
	 * Handles creating or updating of Observation
	 */
	
	public function execute($request, $id = null)
	{
		$request['observation_by'] = auth()->user()->fullname;
		DB::beginTransaction();
			if(!$id) {
				$this->observation = $this->observation->create($request->except(['notify']));
			} else {
				$this->observation = Observation::withTrashed()->findOrFail($id);
				$this->observation->update($request->except(['notify']));

			}

			if($request->filled('notify')) {
				foreach ($this->observation->trip->passengers as $passenger) {
					$passenger->notify(new ObservationNotifyPassenger($this->observation->observation));
				}
			}
		DB::commit();


		return $this->observation;
	}
}