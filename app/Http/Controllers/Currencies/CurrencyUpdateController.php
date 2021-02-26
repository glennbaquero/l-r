<?php

namespace App\Http\Controllers\Currencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Currencies\CurrencyStoreRequest;

use App\Actions\Currencies\CurrencyCreateOrUpdateAction;
use Session;

class CurrencyUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CurrencyCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CurrencyStoreRequest $request, $id)
    {
    	$currency = $this->action->execute($request, $id);
        
        Session::flash('success', 'Currency updated successfully!');

    	return redirect()->back();
    }
}
