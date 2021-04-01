<?php

namespace App\Actions\Cities;

use Illuminate\Support\Facades\DB;

use App\Models\City;

class CityDeleteAction 
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
	 * Handles archiving of City
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->city = City::withTrashed()->findOrFail($id);
				$this->city->delete();
		DB::commit();


		return true;
	}
}