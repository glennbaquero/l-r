<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TicketCollection;
use App\Http\Fetch\TicketFetch;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\City;
use App\Models\Stop;
use App\Models\Trip;
use App\Models\Passenger;
use App\Models\Price;

class TicketController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TicketFetch $fetch)
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
        $user = auth()->user();
        $existing_cash = $user->cashes()->whereDate('created_at', now())->first();

        if(! $existing_cash) {
            return redirect()->route('open-cash.index');
        } 

        return view('pages.ticket.index', [
            'headers' => TicketCollection::$headers,
            'searches' => TicketCollection::$searches,
            'cities' => City::get(),
            'ticket_types' => TicketType::get(),
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new TicketCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Find available trip from selected departure and arrival
     *
     * @return array $trips
     */
    
    public function findAvailableTrip(Request $request)
    {
        $departure = $request->departure_id;
        $arrival = $request->arrival_id;

        $stops = Stop::whereLike('departure_id', $departure)->whereLike('arrival_id', $arrival)->get();

        $trips = [];

        foreach ($stops as $stop) {
            if(!collect($trips)->contains('route', $stop->route)) {
                $availableTrips = $stop->route->trips()->where('date', '>', now());
                if($availableTrips->count()) {
                    if(!collect($trips)->contains('trips', $availableTrips->get())) {
                        array_push($trips, [
                            'route' => $stop->route,
                            'trips' => $availableTrips->orderby('date', 'asc')->get(),
                        ]);   
                    }

                }
            }
            
        }


        $price = Price::where('departure_id', $departure)->where('arrival_id', $arrival)->first();

        return response()->json([
            'trips' => $trips,
            'price' => $price
        ]);

    }

    /**
     * Fetch bus from selected trip
     *
     * @return array $trips
     */
    
    public function getBus(Request $request)
    {

        $trip = Trip::find($request->trip_id);
        $rows = $trip->bus->bus_model->bus_rows;
        $bus_model = [];

        foreach ($rows as $row) {
           $this->renderBusModel($row, $trip);
           array_push($bus_model, $row->bus_columns);

        }
        return response()->json([
            'bus_model' => $bus_model
        ]);

    }

    public function renderBusModel($row, $trip) {

        $response = [];

        foreach ($row->bus_columns as $column) {
            foreach($trip->passengers as $passenger) {
                if($passenger->bus_model_column_id == $column->id) {
                    if($passenger->ticket->payment_method == 'Cash') {
                        $column->image_path = url('icons/seat_reserve.png');
                    } 

                    if($passenger->ticket->payment_method == 'Credit Card') {
                        $column->image_path = url('icons/seat_sold.png');
                    }
                    
                    $column->is_reserved = true;
                }
            }
        }

        return true;
    }

    /**
     * Fetch passenger
     *
     * @return array $trips
     */
    
    public function getPassenger(Request $request)
    {
        $passengers = [];
        if($request->filled('search')) {
            $passengers = Passenger::whereLike('first_name', $request->search)->orWhereLike('last_name', $request->search)->get();
        }

        return response()->json([
            'passengers' => $passengers
        ]);

    }

    public function printTicket($id) 
    {
        $ticket = Ticket::find($id);

        return view('pages.ticket.print', [
            'ticket' => $ticket
        ]);
    }

}
