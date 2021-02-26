<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
// use App\Http\Requests\Users\UserStoreRequest;

use App\Actions\Offices\OfficeCreateOrUpdateAction;
use Session;

class OfficeCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(OfficeCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request)
    {
    	$office = $this->action->execute($request);
        Session::flash('success', 'Office successfully created!');
        return redirect()->route('office.show', $office->id);
    }
}
