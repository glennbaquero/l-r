<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\MultiRouteCollection;
use App\Http\Fetch\MultiRouteFetch;

use App\Models\MultiRoute;
use App\Models\Stop;
use App\Models\City;

class MultiRouteController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(MultiRouteFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\MultiRouteMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.multi-route.index', [
            'headers' => MultiRouteCollection::$headers,
            'searches' => MultiRouteCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new MultiRouteCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderby('name', 'asc')->get();
        $routes = Stop::with('route')->get();

        $headers = [
           'Departure', 'Arrival', 'Auto', 'Routes', 'Options'
        ];

        return view('pages.multi-route.create', [
            'cities' => $cities,
            'headers' => $headers,
            'routes' => $routes,
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $route = MultiRoute::withTrashed()->findOrFail($id);

        $route['stops'] = $route->stops;

        foreach ($route->stops as $stop) {
            $stop['route_per_stop'] = $stop->routes()->pluck('route_id');
        }
        // $route['route_per_stop'] = collect($route->getRoutePerStop());
        $cities = City::orderby('name', 'asc')->get();
        $routes = Stop::with('route')->get();

        $headers = [
           'Departure', 'Arrival', 'Auto', 'Routes', 'Options'
        ];
        
        return view('pages.multi-route.show', [
            'cities' => $cities,
            'route' => $route,
            'headers' => $headers,
            'routes' => $routes,
        ]);
    }

}
