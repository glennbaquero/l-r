<?php

namespace App\Http\Controllers\Groups;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupStoreRequest;

use App\Actions\Groups\GroupCreateOrUpdateAction;
use Session;

class GroupCreateController extends Controller
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
    
    public function __invoke(GroupStoreRequest $request)
    {
    	$group = $this->action->execute($request);
        Session::flash('success', 'Group successfully created!');
        return redirect()->route('group.show', $group->id);
    }
}
