<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PriceCollection;
use App\Http\Fetch\PriceFetch;

use App\Models\Price;
use App\Models\City;
use App\Models\Currency;

class PriceController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(PriceFetch $fetch)
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
        return view('pages.price.index', [
            'headers' => PriceCollection::$headers,
            'searches' => PriceCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new PriceCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::get();
        $currencies = Currency::get();

        return view('pages.price.create', [
            'cities' => $cities,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = Price::withTrashed()->findOrFail($id);
        $cities = City::get();
        $currencies = Currency::get();
        
        return view('pages.price.show', [
            'cities' => $cities,
            'price' => $price,
            'currencies' => $currencies,
        ]);
    }

    /**
     * Show batch upload page
     * 
     * @return Illuminate\Http\Response
     */
    public function upload()
    {
        return view('pages.price.upload', [    
            //
        ]);
    }

}
