<?php

namespace App\Http\Controllers;

use App\Http\Fetch\GroupEmailFetch;
use App\Http\Resources\GroupEmailCollection;
use Illuminate\Http\Request;

use App\Models\GroupEmail;
use App\Models\City;

class GroupEmailController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(GroupEmailFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\GroupEmailMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Group Email index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.group-email.index', [
            'headers' => GroupEmailCollection::$headers,
            'searches' => GroupEmailCollection::$searches,
        ]);
    }

    /**
     * Fetch all Group Emails
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new GroupEmailCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show Group Emails create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.group-email.create', [
            //
        ]);
    }

    /**
     * Show group email view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $group = GroupEmail::withTrashed()->find($id);

        return view('pages.group-email.show', [
            'group' => $group
        ]);
    }
}
