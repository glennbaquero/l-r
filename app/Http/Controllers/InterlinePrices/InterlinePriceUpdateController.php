<?php

namespace App\Http\Controllers\InterlinePrices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Prices\InterlinePriceStoreRequest;

use App\Actions\InterlinePrices\InterlinePriceCreateOrUpdateAction;
use Session;

class InterlinePriceUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(InterlinePriceCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(InterlinePriceStoreRequest $request, $id)
    {
    	$route = $this->action->execute($request, $id);
        
        Session::flash('success', 'Interline Price updated successfully!');

    	return redirect()->back();
    }
}
