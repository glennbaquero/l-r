<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Companies\CompanyStoreRequest;

use App\Actions\Companies\CompanyCreateOrUpdateAction;
use Session;

class CompanyUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CompanyCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CompanyStoreRequest $request, $id)
    {
    	$company = $this->action->execute($request, $id);
        
        Session::flash('success', 'Company updated successfully!');

    	return redirect()->back();
    }
}
