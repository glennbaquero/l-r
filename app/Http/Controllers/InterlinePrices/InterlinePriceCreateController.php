<?php

namespace App\Http\Controllers\InterlinePrices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Prices\InterlinePriceStoreRequest;

use App\Actions\InterlinePrices\InterlinePriceCreateOrUpdateAction;
use Session;

class InterlinePriceCreateController extends Controller
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
    
    public function __invoke(InterlinePriceStoreRequest $request)
    {
    	$route = $this->action->execute($request);
        Session::flash('success', 'Interline Price successfully created!');
        return redirect()->route('interline-price.show', $route->id);
    }
}
