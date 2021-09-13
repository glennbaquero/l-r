<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Routes\CopyAndReverseStoreRequest;

use App\Http\Resources\RouteCollection;
use App\Http\Fetch\RouteFetch;

use App\Models\Route;
use App\Models\City;
use App\Models\Stop;

class RouteController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(RouteFetch $fetch)
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
        return view('pages.route.index', [
            'headers' => RouteCollection::$headers,
            'searches' => RouteCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new RouteCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        $typeOfRoutes = [
            [
                'name' => 'Carga',
            ],
            [
                'name' => 'Pasajes',
            ],
        ];

        $headers = [
           'Show', 'Departure City', 'Arrival City', 'Available From', 'Available To', 'Trip Length', 'Wait Time', 'Distance (KM)', 'Options'
        ];

        return view('pages.route.create', [
            'cities' => $cities,
            'typeOfRoutes' => $typeOfRoutes,
            'headers' => $headers,
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = Route::withTrashed()->findOrFail($id);
        $cities = City::get();
        $typeOfRoutes = [
            [
                'name' => 'Carga',
            ],
            [
                'name' => 'Pasajes',
            ],
        ];

        $headers = [
           'Show', 'Departure City', 'Arrival City', 'Available From', 'Available To', 'Trip Length', 'Wait Time', 'Distance', 'Options'
        ];
        
        return view('pages.route.show', [
            'cities' => $cities,
            'route' => $route,
            'typeOfRoutes' => $typeOfRoutes,
            'headers' => $headers,
        ]);
    }

    /**
     * Copy and reverse route 
     * 
     * @return Illuminate\Http\Response
     */
    public function copyReverse(CopyAndReverseStoreRequest $request, $id)
    {
        $route = Route::withTrashed()->findOrFail($id);
        $stops = $route->stops()->orderby('id', 'desc')->get();

        $new_route = Route::create([
            'name' => $request->name,
            'alias' => $request->alias,
            'report_alias' => $request->report_alias,
            'type_of_route' => $request->type_of_route,
            'trip_length' => $route->trip_length,
            'wait_time' => $route->wait_time,
            'distance' => $route->distance,
            'has_main_co_driver' => $route->has_main_co_driver,
            'has_assistant' => $route->has_assistant,

            'departure_id' => $route->stops()->orderby('id', 'desc')->first()->arrival_id
        ]);


        foreach($stops as $stop) {
            Stop::create([
                'route_id' => $new_route->id,
                'trip_length' => $stop->trip_length,
                'wait_time' => $stop->wait_time,
                'distance' => $stop->distance,
                'division_point' => $stop->division_point,
                'show' => $stop->show,
                'schedule_start' => $stop->schedule_start,
                'schedule_end' => $stop->schedule_end,

                'departure_id' => $stop->arrival_id,
                'arrival_id' => $stop->departure_id,
            ]);
        }
        
        return response()->json([
            'message' => 'Route successfully copy and reversed!',
            'title' => 'Copy and reversed success'
        ]);
    }

}
