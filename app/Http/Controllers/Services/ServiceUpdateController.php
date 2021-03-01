<?php

namespace App\Http\Controllers\Services;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Services\ServiceStoreRequest;

use App\Actions\Services\ServiceCreateOrUpdateAction;
use Session;

class ServiceUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(ServiceCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(ServiceStoreRequest $request, $id)
    {
    	$service = $this->action->execute($request, $id);
        
        Session::flash('success', 'Service updated successfully!');

    	return redirect()->back();
    }
}
