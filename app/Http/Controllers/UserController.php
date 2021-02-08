<?php

namespace App\Http\Controllers;

use App\Http\Fetch\UserFetch;
use App\Http\Resources\UserCollection;
use Illuminate\Http\Request;

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
}
