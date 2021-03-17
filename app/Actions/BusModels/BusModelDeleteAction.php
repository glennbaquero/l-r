<?php

namespace App\Actions\BusModels;

use Illuminate\Support\Facades\DB;

use App\Models\BusModel;

class BusModelDeleteAction 
{
	protected $model;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(BusModel $model)
	{
		$this->model = $model;
	}

	/**
	 * Handles archiving of bus model
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->model = BusModel::withTrashed()->findOrFail($id);
				$this->model->delete();
		DB::commit();


		return true;
	}
}