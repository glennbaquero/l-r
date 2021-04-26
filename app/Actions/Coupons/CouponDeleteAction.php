<?php

namespace App\Actions\Coupons;

use Illuminate\Support\Facades\DB;

use App\Models\Coupon;

class CouponDeleteAction 
{
	protected $coupon;

	/**
	 * Create new action instance
	 *
	 * @return void
	 */
	
	public function __construct(Coupon $coupon)
	{
		$this->coupon = $coupon;
	}

	/**
	 * Handles archiving of Coupon
	 */
	
	public function execute($id)
	{

		DB::beginTransaction();
				$this->coupon = Coupon::withTrashed()->findOrFail($id);
				$this->coupon->delete();
		DB::commit();


		return true;
	}
}