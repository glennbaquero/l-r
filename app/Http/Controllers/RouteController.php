<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RouteCollection;
use App\Http\Fetch\RouteFetch;

use App\Models\Route;
use App\Models\City;

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
           'Punto Division', 'Show', 'Departure City', 'Arrival City', 'Trip Length', 'Wait Time', 'Distance', 'Options'
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
           'Punto Division', 'Show', 'Departure City', 'Arrival City', 'Trip Length', 'Wait Time', 'Distance', 'Options'
        ];
        
        return view('pages.route.show', [
            'cities' => $cities,
            'route' => $route,
            'typeOfRoutes' => $typeOfRoutes,
            'headers' => $headers,
        ]);
    }

}
