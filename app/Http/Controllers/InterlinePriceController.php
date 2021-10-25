<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\InterlinePriceCollection;
use App\Http\Fetch\InterlinePriceFetch;

use App\Models\InterlinePrice;
use App\Models\City;
use App\Models\Currency;
use App\Models\Company;

class InterlinePriceController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(InterlinePriceFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\InterlinePriceMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.interline-price.index', [
            'headers' => InterlinePriceCollection::$headers,
            'searches' => InterlinePriceCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new InterlinePriceCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::orderby('name', 'asc')->get();
        $currencies = Currency::get();
        $companies = Company::get();

        return view('pages.interline-price.create', [
            'cities' => $cities,
            'currencies' => $currencies,
            'companies' => $companies,
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $price = InterlinePrice::withTrashed()->findOrFail($id);
        $cities = City::orderby('name', 'asc')->get();
        $currencies = Currency::get();
        $companies = Company::get();
        
        return view('pages.interline-price.show', [
            'cities' => $cities,
            'price' => $price,
            'currencies' => $currencies,
            'companies' => $companies,
        ]);
    }

}
