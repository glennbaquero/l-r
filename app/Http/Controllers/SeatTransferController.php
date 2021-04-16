<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Ticket;
use App\Models\Trip;
use App\Models\City;
use App\Models\Route;
use App\Models\Stop;

class SeatTransferController extends Controller
{
    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.seat-transfer.index', [
            'cities' => City::get(),
            'routes' => Route::get(),
        ]);
    }


    /**
     * Fetch Trip list from the selected departure and date
     *
     * @return array $trips
     */
    
    public function getTrip(Request $request)
    {
        $routes = Route::whereHas('stops', function($stop) use($request) {
            if($request->type == 'origin') {
                $stop->where('departure_id', $request->id);
            } else {
                $stop->where('arrival_id', $request->id);
            }

        })->get();

        $trips = [];

        foreach ($routes as $route) {
            $get_trips = $route->trips()->whereDate('date', $request->date)->get();
            foreach ($get_trips as $key => $trip) {
                $rows = $trip->bus->bus_model->bus_rows;
                array_push($trips, [
                    'id' => $trip->id,
                    'route_id' => $route->id,
                    'display' => $trip->display_trip_name,
                    'tickets' => $trip->getTickets()
                ]);
            }
        }

        return response()->json([
            'trips' => $trips,
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

    public function renderBusModel($row, $trip) 
    {

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
                    $column['ticket'] = $passenger->ticket;
                    $column->is_reserved = true;
                }
            }
        }

        return true;
    }

    public function update(Request $request)
    {
        $ticket = Ticket::find($request->ticket);

        if($request->from == 'origin') {
            $ticket->update([
                'bus_model_column_id' => $request->destination_seat_id,
                'trip_id' => $request->destination_trip_id,
                'arrival_id' => $request->arrival_id,
                'departure_id' => $request->departure_id,
            ]);

            $ticket->passenger()->update([
                'bus_model_column_id' => $request->destination_seat_id,
                'trip_id' => $request->destination_trip_id,
            ]);
        }
        
        if($request->from == 'destination') {
            $ticket->update([
                'bus_model_column_id' => $request->origin_seat_id,
                'trip_id' => $request->origin_trip_id,
                'arrival_id' => $request->arrival_id,
                'departure_id' => $request->departure_id,
            ]);

            $ticket->passenger()->update([
                'bus_model_column_id' => $request->origin_seat_id,
                'trip_id' => $request->origin_trip_id,
            ]);
        }

        return response()->json([
            'success' => true
        ]);
    }

}
