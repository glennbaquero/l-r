<?php

namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cities\CityStoreRequest;

use App\Actions\Cities\CityCreateOrUpdateAction;
use Session;

class CityCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CityCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CityStoreRequest $request)
    {
    	$city = $this->action->execute($request);
        Session::flash('success', 'City successfully created!');
        return redirect()->route('city.show', $city->id);
    }
}
