<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RouteAndMainDriverCollection;
use App\Http\Fetch\RouteAndMainDriverFetch;

use App\Models\RouteAndMainDriver;
use App\Models\Driver;
use App\Models\City;

class RouteAndMainDriverController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(RouteAndMainDriverFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\RouteAndMainDriverMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.route-main-driver.index', [
            'headers' => collect(RouteAndMainDriverCollection::$headers),
            'headers_voucher_route' => collect(RouteAndMainDriverCollection::$headers_voucher_route),
            'headers_excess_luggage' => collect(RouteAndMainDriverCollection::$headers_excess_luggage),
            'searches' => RouteAndMainDriverCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new RouteAndMainDriverCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.route-main-driver.create', [
            'drivers' => Driver::get(),
            'cities' => City::orderby('name', 'asc')->get(),
            'types' => RouteAndMainDriver::getType()
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = RouteAndMainDriver::withTrashed()->findOrFail($id);

        return view('pages.route-main-driver.show', [
            'item' => $item,
            'drivers' => Driver::get(),
            'cities' => City::orderby('name', 'asc')->get(),
            'types' => RouteAndMainDriver::getType()
        ]);
    }
}
