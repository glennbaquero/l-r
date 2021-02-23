<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Users\UserStoreRequest;

use App\Actions\Users\UserCreateOrUpdateAction;
use Session;

class UserCreateController extends Controller
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
    
    public function __invoke(UserStoreRequest $request)
    {
    	$request['password'] = \Hash::make(uniqid());
    	$user = $this->action->execute($request);
        Session::flash('success', 'User successfully created!');
        return redirect()->route('user.show', $user->id);
    }
}
