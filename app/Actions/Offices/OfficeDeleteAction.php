<?php

namespace App\Actions\Offices;

use Illuminate\Support\Facades\DB;

use App\Models\Office;

class OfficeDeleteAction 
{
	protected $office;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Office $office)
	{
		$this->office = $office;
	}

	/**
	 * Handles archiving of Office
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->office = Office::withTrashed()->findOrFail($id);
				$this->office->delete();
		DB::commit();


		return true;
	}
}