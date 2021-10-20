<?php

namespace App\Http\Controllers;

use App\Http\Fetch\TripFetch;
use App\Http\Resources\TripCollection;
use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\TripTime;
use App\Models\City;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Service;
use App\Models\Route;
use App\Models\Company;

class TripController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TripFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\TripMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.trip.index', [
            'headers' => TripCollection::$headers,
            'searches' => TripCollection::$searches,
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
        return new TripCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show Trips create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $drivers = Driver::get();
        $services = Service::get();
        $buses = Bus::get();
        $routes = Route::get();
        $companies = Company::get();

        $crews = [];
        $assistants = [];
        $transport_types = [
            [ 'name' => 'Carga'], [ 'name' => 'Tickets']
        ];

        return view('pages.trip.create', [
            'drivers' => $drivers,
            'services' => $services,
            'buses' => $buses,
            'routes' => $routes,
            'companies' => $companies,
            'transport_types' => $transport_types,
            'crews' => $crews,
            'assistants' => $assistants,
        ]);
    }

    /**
     * Show trip view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::withTrashed()->find($id);
        $drivers = Driver::get();
        $services = Service::get();
        $buses = Bus::get();
        $routes = Route::get();
        $companies = Company::get();

        $crews = [];
        $assistants = [];
        $transport_types = [
            [ 'name' => 'Carga'], [ 'name' => 'Tickets']
        ];

        return view('pages.trip.show', [
            'trip' => $trip,
            'drivers' => $drivers,
            'services' => $services,
            'buses' => $buses,
            'routes' => $routes,
            'companies' => $companies,
            'transport_types' => $transport_types,
            'crews' => $crews,
            'assistants' => $assistants,
        ]);
    }

    /**
     * Show trip view page
     * 
     * @return Illuminate\Http\Response
     */
    public function deleteTime($id)
    {
        $time = TripTime::find($id);

        $time->delete();
       
        return true;
    }
}
