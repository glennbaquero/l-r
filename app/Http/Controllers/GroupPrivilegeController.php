<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\GroupPrivilegeCollection;
use App\Http\Fetch\GroupPrivilegeFetch;

use App\Models\Group;
use App\Models\GroupPrivilege;

class GroupPrivilegeController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(GroupPrivilegeFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\GroupPrivilegeMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $headers = collect(GroupPrivilegeCollection::$headers);
        $group_data = collect(Group::pluck('name')->toArray());
        $group_data = $headers->merge($group_data);
        $group_data->all();
        $headers = $group_data->toArray();

        return view('pages.group-privilege.index', [
            'headers' => $headers,
            'searches' => GroupPrivilegeCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new GroupPrivilegeCollection($this->fetch->execute(request()->input()));
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
        $group = group::find($id);

        return view('pages.group.show', [
            'group' => $group
        ]);
    }

}
