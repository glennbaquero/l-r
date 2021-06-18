<?php

namespace App\Http\Controllers\AccountPayables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountPayables\AccountPayableStoreRequest;

use App\Actions\AccountPayables\AccountPayableCreateOrUpdateAction;
use Session;

class AccountPayableCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(AccountPayableCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(AccountPayableStoreRequest $request)
    {
    	$item = $this->action->execute($request);
        Session::flash('success', 'Account Payable successfully created!');
        return redirect()->route('account-payable.show', $item->id);
    }
}
