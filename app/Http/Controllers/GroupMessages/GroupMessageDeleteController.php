<?php

namespace App\Http\Controllers\GroupMessages;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\GroupMessages\GroupMessageDeleteAction;

class GroupMessageDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupMessageDeleteAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $id)
    {
    	$group = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
