<?php

namespace App\Http\Controllers\GroupEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupEmailStoreRequest;

use App\Actions\GroupEmails\GroupEmailCreateOrUpdateAction;
use Session;

class GroupEmailCreateController extends Controller
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
    
    public function __invoke(GroupEmailStoreRequest $request)
    {
    	$group = $this->action->execute($request);
        Session::flash('success', 'Group email successfully created!');
        return redirect()->route('group-email.show', $group->id);
    }
}
