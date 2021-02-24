<?php

namespace App\Http\Controllers\GroupMessages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Groups\GroupMessageStoreRequest;

use App\Actions\GroupMessages\GroupMessageCreateOrUpdateAction;
use Session;

class GroupMessageUpdateController extends Controller
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
    
    public function __invoke(GroupMessageStoreRequest $request, $id)
    {
        $request['userIds'] = json_decode($request->userIds);
    	$group = $this->action->execute($request, $id);
        
        Session::flash('success', 'Group updated successfully!');

    	return redirect()->back();
    }
}
