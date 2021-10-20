<?php

namespace App\Http\Controllers;

use App\Http\Fetch\PassengerFetch;
use App\Http\Resources\PassengerCollection;
use Illuminate\Http\Request;

use App\Models\Passenger;

class PassengerController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(PassengerFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\PassengerMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Passenger index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.frequent-traveler.index', [
            'headers' => PassengerCollection::$headers,
            'searches' => PassengerCollection::$searches,
        ]);
    }

    /**
     * Fetch all Trips
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {

        if(request()->input()['type'] == 'null') {
            request()->request->add(['type' => 'all']);
        }

        return new PassengerCollection($this->fetch->execute(request()->input()));
    }
}
