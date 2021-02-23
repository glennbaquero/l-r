<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UserStoreRequest;

use App\Actions\Users\UserCreateOrUpdateAction;
use Session;

class UserUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(UserCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(UserStoreRequest $request, $id)
    {
    	$user = $this->action->execute($request, $id);
        
        Session::flash('success', 'User updated successfully!');

    	return redirect()->back();
    }
}
