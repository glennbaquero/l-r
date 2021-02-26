<?php

namespace App\Http\Controllers\Companies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Companies\CompanyStoreRequest;

use App\Actions\Companies\CompanyCreateOrUpdateAction;
use Session;

class CompanyCreateController extends Controller
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
    
    public function __invoke(CompanyStoreRequest $request)
    {
    	$company = $this->action->execute($request);
        Session::flash('success', 'Company successfully created!');
        return redirect()->route('company.show', $company->id);
    }
}
