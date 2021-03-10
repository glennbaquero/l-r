<?php

namespace App\Actions\Offices;

use Illuminate\Support\Facades\DB;

use App\Models\Office;

class OfficeCreateOrUpdateAction 
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
	 * Handles creating or updating of office
	 */
	
	public function execute($request, $id = null)
	{
		$request['main_stop_office'] = $request->filled('main_stop_office');
		$request['boarding_landing'] = $request->filled('boarding_landing');
		$request['pre_printed_voucher'] = $request->filled('pre_printed_voucher');
		$request['shipping_office'] = $request->filled('shipping_office');
		$request['collect_commission_only'] = $request->filled('collect_commission_only');
		$request['commission_type'] = $request->filled('commission_type') ? 'P' : 'M';
		$request['hide_price'] = $request->filled('hide_price');
		$request['print_to_capture'] = $request->filled('print_to_capture');
		$request['sell_remote_tickets'] = $request->filled('sell_remote_tickets');
		$request['pays_net_amount'] = $request->filled('pays_net_amount');

		DB::beginTransaction();
			if(!$id) {
				$request['office_no'] = bin2hex(random_bytes(3));
				$this->office = $this->office->create($request->all());
			} else {
				$this->office = Office::withTrashed()->findOrFail($id);
				$this->office->update($request->all());
			}
		DB::commit();


		return $this->office;
	}
}