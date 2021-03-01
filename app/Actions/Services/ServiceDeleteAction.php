<?php

namespace App\Actions\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Service;

class ServiceDeleteAction 
{
	protected $service;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Service $service)
	{
		$this->service = $service;
	}

	/**
	 * Handles archiving of Service
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->service = Service::withTrashed()->findOrFail($id);
				$this->service->delete();
		DB::commit();


		return true;
	}
}