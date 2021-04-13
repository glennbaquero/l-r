<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Coupons\CouponStoreRequest;

use App\Actions\Coupons\CouponCreateOrUpdateAction;
use Session;

class CouponCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CouponCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CouponStoreRequest $request)
    {
    	$coupon = $this->action->execute($request);
        Session::flash('success', 'Coupon successfully created!');
        return redirect()->route('coupon.show', $coupon->id);
    }
}
