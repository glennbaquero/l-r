<?php

namespace App\Http\Controllers\Drivers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Drivers\DriverStoreRequest;

use App\Actions\Drivers\DriverCreateOrUpdateAction;
use Session;

class DriverUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(DriverCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(DriverStoreRequest $request, $id)
    {
    	$driver = $this->action->execute($request, $id);
        
        Session::flash('success', 'Driver updated successfully!');

    	return redirect()->back();
    }
}
