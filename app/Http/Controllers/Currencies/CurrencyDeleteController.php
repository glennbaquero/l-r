<?php

namespace App\Http\Controllers\Currencies;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Currencys\CurrencyDeleteAction;

class CurrencyDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CurrencyDeleteAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $id)
    {
    	$currency = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
