<?php

namespace App\Http\Controllers\Coupons;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Coupons\CouponStoreRequest;

use App\Actions\Coupons\CouponCreateOrUpdateAction;
use Session;

class CouponUpdateController extends Controller
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
    
    public function __invoke(CouponStoreRequest $request, $id)
    {
    	$coupon = $this->action->execute($request, $id);
        
        Session::flash('success', 'Coupon updated successfully!');

    	return redirect()->back();
    }
}
