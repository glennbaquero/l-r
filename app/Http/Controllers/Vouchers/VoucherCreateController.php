<?php

namespace App\Http\Controllers\Vouchers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Vouchers\VoucherStoreRequest;

use App\Actions\Vouchers\VoucherCreateOrUpdateAction;
use Session;

class VoucherCreateController extends Controller
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
    
    public function __invoke(VoucherStoreRequest $request)
    {
    	$voucher = $this->action->execute($request);
        Session::flash('success', 'Voucher successfully created!');
        return redirect()->route('voucher.show', $voucher->id);
    }
}
