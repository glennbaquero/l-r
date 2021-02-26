<?php

namespace App\Http\Controllers\Currencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Currencies\CurrencyStoreRequest;

use App\Actions\Currencies\CurrencyCreateOrUpdateAction;
use Session;

class CurrencyCreateController extends Controller
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
    
    public function __invoke(CurrencyStoreRequest $request)
    {
    	$currency = $this->action->execute($request);
        Session::flash('success', 'Currency successfully created!');
        return redirect()->route('currency.show', $currency->id);
    }
}
