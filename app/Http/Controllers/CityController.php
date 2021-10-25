<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CityCollection;
use App\Http\Fetch\CityFetch;

use App\Models\City;

class CityController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(CityFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\CityMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.city.index', [
            'headers' => CityCollection::$headers,
            'searches' => CityCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new CityCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.city.create', [
            //
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $city = City::withTrashed()->findOrFail($id);

        return view('pages.city.show', [
            'city' => $city,
        ]);
    }

    /**
     * Show batch upload page
     * 
     * @return Illuminate\Http\Response
     */
    public function upload()
    {
        return view('pages.city.upload', [    
            //
        ]);
    }
}
