<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Trip;
use App\Models\City;
use App\Models\Bus;
use App\Models\Driver;
use App\Models\Service;
use App\Models\Route;
use App\Models\Company;

class TravelScheduleController extends Controller
{

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\TravelScheduleMiddleware');
    }

    /**
     * Show Travel Schedule create page
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

        $transport_types = [
            [ 'name' => 'Carga'], [ 'name' => 'Tickets']
        ];

        return view('pages.travel-schedule.create', [
            'drivers' => $drivers,
            'services' => $services,
            'buses' => $buses,
            'routes' => $routes,
            'companies' => $companies,
            'transport_types' => $transport_types,
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

        $transport_types = [
            [ 'name' => 'Carga'], [ 'name' => 'Tickets']
        ];

        return view('pages.travel-schedule.show', [
            'trip' => $trip,
            'drivers' => $drivers,
            'services' => $services,
            'buses' => $buses,
            'routes' => $routes,
            'companies' => $companies,
            'transport_types' => $transport_types,
        ]);
    }
}
