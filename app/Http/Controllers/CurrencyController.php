<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CurrencyCollection;
use App\Http\Fetch\CurrencyFetch;

use App\Models\Currency;
use App\Models\Country;

class CurrencyController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(CurrencyFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\CurrencyMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.currency.index', [
            'headers' => CurrencyCollection::$headers,
            'searches' => CurrencyCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new CurrencyCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::get();

        return view('pages.currency.create', [
            'countries' => $countries
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $currency = Currency::withTrashed()->findOrFail($id);
        $countries = Country::get();

        return view('pages.currency.show', [
            'currency' => $currency,
            'countries' => $countries
        ]);
    }

}
