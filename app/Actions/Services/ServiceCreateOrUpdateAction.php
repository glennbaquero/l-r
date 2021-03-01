<?php

namespace App\Actions\Services;

use Illuminate\Support\Facades\DB;

use App\Models\Service;

class ServiceCreateOrUpdateAction 
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
	 * Handles creating or updating of office
	 */
	
	public function execute($request, $id = null)
	{
		$request['apply_external_services'] = $request->filled('apply_external_services');

		DB::beginTransaction();
			if(!$id) {
				$this->service = $this->service->create($request->all());
			} else {
				$this->service = Service::withTrashed()->findOrFail($id);
				$this->service->update($request->all());
			}
		DB::commit();


		return $this->service;
	}
}