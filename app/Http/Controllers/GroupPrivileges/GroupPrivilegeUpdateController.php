<?php

namespace App\Http\Controllers\GroupPrivileges;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\GroupPrivileges\GroupPrivilegeCreateOrUpdateAction;
use Session;

class GroupPrivilegeUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupPrivilegeCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $groupId, $groupPrivilegeId)
    {
    	$group = $this->action->execute($groupId, $groupPrivilegeId);
        
        Session::flash('success', 'Group updated successfully!');

    	return redirect()->back();
    }
}
