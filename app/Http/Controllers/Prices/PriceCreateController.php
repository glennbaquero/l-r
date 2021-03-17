<?php

namespace App\Http\Controllers\Prices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Prices\PriceStoreRequest;

use App\Actions\Prices\PriceCreateOrUpdateAction;
use Session;

class PriceCreateController extends Controller
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
    
    public function __invoke(PriceStoreRequest $request)
    {
    	$route = $this->action->execute($request);
        Session::flash('success', 'Price successfully created!');
        return redirect()->route('price.show', $route->id);
    }
}
