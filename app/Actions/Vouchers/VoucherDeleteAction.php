<?php

namespace App\Actions\Vouchers;

use Illuminate\Support\Facades\DB;

use App\Models\Voucher;

class VoucherDeleteAction 
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
	 * Handles archiving of Voucher
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->voucher = Voucher::withTrashed()->findOrFail($id);
				$this->voucher->delete();
		DB::commit();


		return true;
	}
}