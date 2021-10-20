<?php

namespace App\Http\Controllers;

use App\Http\Fetch\UserFetch;
use App\Http\Resources\UserCollection;
use App\Http\Resources\OfficeCollection;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\Group;
use App\Models\User;
use App\Models\Country;

class UserController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(UserFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\UserMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.user.index', [
            'headers' => UserCollection::$headers,
            'searches' => UserCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new UserCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.user.create', [
            'offices' => Office::get(),
            'groups' => Group::get(),
            'countries' => Country::get(),
        ]);
    }

    /**
     * Show users view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);

        return view('pages.user.show', [
            'offices' => Office::get(),
            'groups' => Group::get(),
            'countries' => Country::get(),

            'user' => $user
        ]);
    }
}
