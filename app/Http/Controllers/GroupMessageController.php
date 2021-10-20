<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\GroupMessageCollection;
use App\Http\Fetch\GroupMessageFetch;

use App\Models\GroupMessage;
use App\Models\User;

class GroupMessageController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(GroupMessageFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\GroupMessagelMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.group-message.index', [
            'headers' => GroupMessageCollection::$headers,
            'searches' => GroupMessageCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new GroupMessageCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();

        return view('pages.group-message.create', [
            'users' => $users
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = GroupMessage::find($id);
        $group['userIds'] = $group->users()->pluck('user_id');
        $users = User::get();

        return view('pages.group-message.show', [
            'group' => $group,
            'users' => $users,
        ]);
    }

}
