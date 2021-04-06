<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Vouchers\VoucherStoreRequest;

use App\Actions\Vouchers\VoucherCreateOrUpdateAction;
use Session;

class VoucherUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(VoucherCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(VoucherStoreRequest $request, $id)
    {
    	$voucher = $this->action->execute($request, $id);
        
        Session::flash('success', 'Voucher updated successfully!');

    	return redirect()->back();
    }
}
