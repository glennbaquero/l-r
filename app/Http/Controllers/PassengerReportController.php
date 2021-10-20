<?php

namespace App\Http\Controllers;

use App\Http\Fetch\TripFetch;
use App\Http\Fetch\TicketFetch;
use App\Http\Resources\TripCollection;
use App\Http\Resources\TicketCollection;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\Route;

class PassengerReportController extends Controller
{
    protected $fetch;
    protected $ticket;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TripFetch $fetch, TicketFetch $ticket)
    {
        $this->middleware('App\Http\Middleware\PassengerReportMiddleware');
        $this->fetch = $fetch;
        $this->ticket = $ticket;
    }

    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.reports.passenger.passenger', [
            'headers' => TripCollection::$headers_report,
            'passenger_reports_header' => TripCollection::$passenger_reports_header,
            'searches' => TripCollection::$searches,
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

        if(request()->input()['date'] == 'null') {
            request()->request->add(['date' => now()]);
        }

        return new TripCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Fetch all Passenger belongs to specific trip
     * 
     * @return Illuminate\Http\Response
     */
    public function fetchPassenger($id, $type)
    {
        request()->request->add(['trip' => $id]);
        request()->request->add(['type' => $type]);
        request()->request->add(['passenger' => null]);
        request()->request->add(['office_id' => null]);
        return new TicketCollection($this->ticket->execute(request()->input()));
    }

}
