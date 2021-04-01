<?php

namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Cities\CityStoreRequest;

use App\Actions\Cities\CityCreateOrUpdateAction;
use Session;

class CityUpdateController extends Controller
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
    
    public function __invoke(CityStoreRequest $request, $id)
    {
    	$city = $this->action->execute($request, $id);
        
        Session::flash('success', 'City updated successfully!');

    	return redirect()->back();
    }
}
