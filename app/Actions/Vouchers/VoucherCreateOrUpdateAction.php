<?php

namespace App\Actions\Vouchers;

use Illuminate\Support\Facades\DB;

use App\Models\Voucher;

class VoucherCreateOrUpdateAction 
{
	protected $voucher;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Voucher $voucher)
	{
		$this->voucher = $voucher;
	}

	/**
	 * Handles creating or updating of Voucher
	 */
	
	public function execute($request, $id = null)
	{
		DB::beginTransaction();
			if(!$id) {
				$request['code'] = bin2hex(random_bytes(3));
				$this->voucher = $this->voucher->create($request->all());
			} else {
				$this->voucher = Voucher::withTrashed()->findOrFail($id);
				$this->voucher->update($request->all());
			}
		DB::commit();

		return $this->voucher;
	}
}