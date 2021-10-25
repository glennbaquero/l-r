<?php

namespace App\Actions\Cities;

use Illuminate\Support\Facades\DB;

use App\Models\City;

class CityCreateOrUpdateAction 
{
	protected $city;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(City $city)
	{
		$this->city = $city;
	}

	/**
	 * Handles creating or updating of City
	 */
	
	public function execute($request, $id = null)
	{
		$request['city'] = $request->name;
		DB::beginTransaction();
			if(!$id) {
				$this->city = $this->city->create($request->all());
			} else {
				$this->city = City::withTrashed()->findOrFail($id);
				$this->city->update($request->all());
			}
		DB::commit();

		return $this->city;
	}
}