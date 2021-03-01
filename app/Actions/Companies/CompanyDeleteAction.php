<?php

namespace App\Actions\Companies;

use Illuminate\Support\Facades\DB;

use App\Models\Company;

class CompanyDeleteAction 
{
	protected $company;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Company $company)
	{
		$this->company = $company;
	}

	/**
	 * Handles archiving of Company
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->company = Company::withTrashed()->findOrFail($id);
				$this->company->delete();
		DB::commit();


		return true;
	}
}