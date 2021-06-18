<?php

namespace App\Http\Controllers\AccountPayables;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\AccountPayables\AccountPayableStoreRequest;

use App\Actions\AccountPayables\AccountPayableCreateOrUpdateAction;
use Session;

class AccountPayableUpdateController extends Controller
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
    
    public function __invoke(AccountPayableStoreRequest $request, $id)
    {
    	$item = $this->action->execute($request, $id);
        
        Session::flash('success', 'Account Payable updated successfully!');

    	return redirect()->back();
    }
}
