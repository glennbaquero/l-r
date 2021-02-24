<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupStoreRequest;

use App\Actions\Groups\GroupCreateOrUpdateAction;
use Session;

class GroupUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(GroupStoreRequest $request, $id)
    {
    	$group = $this->action->execute($request, $id);
        
        Session::flash('success', 'Group updated successfully!');

    	return redirect()->back();
    }
}
