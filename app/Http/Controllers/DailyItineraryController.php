<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DailyItineraryFetch;
use App\Http\Resources\DailyItineraryCollection;
use Illuminate\Http\Request;

use App\Models\Trip;

class DailyItineraryController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(DailyItineraryFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\DailyItineraryMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.daily-itinerary.index', [
            'headers' => DailyItineraryCollection::$headers,
            'searches' => DailyItineraryCollection::$searches,
        ]);
    }

    /**
     * Fetch all Trips
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new DailyItineraryCollection($this->fetch->execute(request()->input()));
    }
}
