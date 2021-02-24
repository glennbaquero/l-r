<?php

namespace App\Http\Controllers\GroupMessages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupMessageStoreRequest;

use App\Actions\GroupMessages\GroupMessageCreateOrUpdateAction;
use Session;

class GroupMessageCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupMessageCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(GroupMessageStoreRequest $request)
    {
        $request['userIds'] = json_decode($request->userIds);
    	$group = $this->action->execute($request);
        Session::flash('success', 'Group successfully created!');
        return redirect()->route('group-message.show', $group->id);
    }
}
