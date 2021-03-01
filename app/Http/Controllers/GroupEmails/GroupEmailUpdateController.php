<?php

namespace App\Http\Controllers\GroupEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupEmailStoreRequest;

use App\Actions\GroupEmails\GroupEmailCreateOrUpdateAction;
use Session;

class GroupEmailUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupEmailCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(GroupEmailStoreRequest $request, $id)
    {
    	$group = $this->action->execute($request, $id);
        
        Session::flash('success', 'Group Email updated successfully!');

    	return redirect()->back();
    }
}
