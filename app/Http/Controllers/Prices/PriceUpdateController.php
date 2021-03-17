<?php

namespace App\Http\Controllers\Prices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Prices\PriceStoreRequest;

use App\Actions\Prices\PriceCreateOrUpdateAction;
use Session;

class PriceUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PriceCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(PriceStoreRequest $request, $id)
    {
    	$route = $this->action->execute($request, $id);
        
        Session::flash('success', 'Price updated successfully!');

    	return redirect()->back();
    }
}
