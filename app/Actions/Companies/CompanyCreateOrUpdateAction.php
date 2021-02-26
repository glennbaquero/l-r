<?php

namespace App\Actions\Companies;

use Illuminate\Support\Facades\DB;

use App\Models\Company;

class CompanyCreateOrUpdateAction 
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
	 * Handles creating or updating of Company
	 */
	
	public function execute($request, $id = null)
	{
		$request['company_to_transfer'] = $request->filled('company_to_transfer');
		$request['shipment_of_package'] = $request->filled('shipment_of_package');
		$request['company_interlines'] = $request->filled('company_interlines');
		$request['contract_company'] = $request->filled('contract_company');
		$request['own_company'] = $request->filled('own_company');
		$request['credit_assign'] = $request->filled('credit_assign');
		$request['type_of_credit_line'] = $request->filled('type_of_credit_line') ? 'Unlimited' : 'Limited';
		$request['max_credit_line'] = $request->filled('max_credit_line');
		$request['print_bill'] = $request->filled('print_bill');

		DB::beginTransaction();
			if(!$id) {
				$this->company = $this->company->create($request->all());
			} else {
				$this->company = Company::withTrashed()->findOrFail($id);
				$this->company->update($request->all());
			}
		DB::commit();

		return $this->company;
	}
}