<?php

namespace App\Http\Controllers\GroupEmails;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\GroupEmails\GroupEmailDeleteAction;

class GroupEmailDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(GroupEmailDeleteAction $action)
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
