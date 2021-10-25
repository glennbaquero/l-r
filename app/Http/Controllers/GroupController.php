<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\GroupCollection;
use App\Http\Fetch\GroupFetch;

use App\Models\Group;

class GroupController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(GroupFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\GroupMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.group.index', [
            'headers' => GroupCollection::$headers,
            'searches' => GroupCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new GroupCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.group.create', [
            //
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = Group::withTrashed()->findOrFail($id);

        return view('pages.group.show', [
            'group' => $group
        ]);
    }

}
