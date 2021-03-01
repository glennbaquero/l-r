<?php

namespace App\Http\Controllers\Offices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Offices\OfficeStoreRequest;

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
    
    public function __invoke(OfficeStoreRequest $request)
    {
    	$office = $this->action->execute($request);
        Session::flash('success', 'Office successfully created!');
        return redirect()->route('office.show', $office->id);
    }
}
