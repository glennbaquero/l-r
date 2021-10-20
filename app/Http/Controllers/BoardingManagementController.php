<?php

namespace App\Http\Controllers;

use App\Http\Fetch\ItineraryUpdateFetch;
use App\Http\Resources\ItineraryUpdateCollection;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\City;
use App\Models\Route;
use App\Models\Ticket;

use Carbon\Carbon;

class BoardingManagementController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(ItineraryUpdateFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\BoardingManagementMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.boarding-management.index', [
            'headers' => ItineraryUpdateCollection::$headers,
            'searches' => ItineraryUpdateCollection::$searches,
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
        if(request()->input()['date'] == 'null') {
            request()->request->add(['date' => now()->format('Y-m-d')]);
        }
        
        return new ItineraryUpdateCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Fetch all Trips
     * 
     * @return Illuminate\Http\Response
     */
    public function search(Request $request)
    {
        $result = Ticket::findOrFail($request->ticket_id);
        $result['travel_date'] =  Carbon::parse($result->passenger->trip->date.' '.$result->passenger->trip->time)->format('F j, Y g:i A');
        $result['departure'] = $result->passenger->trip->route->departure->name;
        $result['service'] = $result->passenger->trip->service->name;
        $result['seat'] = $result->passenger->bus_model_column->label;
        $result['office'] = $result->seller->office ? $result->seller->office->name : '---';
        $result['seller_fullname'] = $result->seller->fullname;
        $result['phone_number'] = $result->passenger->phone_number;
        $result['passenger_fullname'] = $result->passenger->fullname;
        $result['purchase_date'] = Carbon::parse($result->purchase_date)->format('F j, Y g:i A');
        $result['state'] = $result->payment_status.'/'.$result->boarding_status;
        $result['arrival'] = $result->passenger->arrival->name;
        $result['observations'] = null;
        $result['price'] = number_format($result->total_sale, 2, '.', ',');

        return response()->json([
            'result' => $result
        ]);
    }
}
