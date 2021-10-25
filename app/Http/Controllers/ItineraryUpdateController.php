<?php

namespace App\Http\Controllers;

use App\Http\Fetch\ItineraryUpdateFetch;
use App\Http\Fetch\ItineraryUpdatePassengerFetch;
use App\Http\Fetch\ObservationFetch;
use App\Http\Resources\ItineraryUpdateCollection;
use App\Http\Resources\ItineraryUpdatePassengerCollection;
use App\Http\Resources\ObservationCollection;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\City;
use App\Models\Route;

class ItineraryUpdateController extends Controller
{
    protected $fetch;
    protected $passenger;
    protected $observation;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(ItineraryUpdateFetch $fetch, ItineraryUpdatePassengerFetch $passenger, ObservationFetch $observation)
    {
        $this->middleware('App\Http\Middleware\ItineraryUpdateMiddleware');
        $this->fetch = $fetch;
        $this->passenger = $passenger;
        $this->observation = $observation;
    }

    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.itinerary-update.index', [
            'headers' => ItineraryUpdateCollection::$headers,
            'searches' => ItineraryUpdateCollection::$searches,
            'passengerHeaders' => ItineraryUpdatePassengerCollection::$headers,
            'observationHeaders' => ObservationCollection::$headers,
            'cities' => City::orderby('name', 'asc')->get(),
            'routes' => Route::get()
        ]);
    }

    /**
     * Fetch all Trips
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new ItineraryUpdateCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Fetch all Passenger belongs to specific trip
     * 
     * @return Illuminate\Http\Response
     */
    public function fetchPassenger($id)
    {
        request()->request->add(['trip_id' => $id]);
        return new ItineraryUpdatePassengerCollection($this->passenger->execute(request()->input()));
    }

    /**
     * Fetch all Observation belongs to specific trip
     * 
     * @return Illuminate\Http\Response
     */
    public function fetchObservation($id)
    {
        request()->request->add(['trip_id' => $id]);
        return new ObservationCollection($this->observation->execute(request()->input()));
    }
}
