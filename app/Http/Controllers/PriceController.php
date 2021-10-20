<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\Prices\DuplicatePriceStoreRequest;

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
        $this->middleware('App\Http\Middleware\PriceMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $cities = City::orderby('name', 'asc')->get();
        return view('pages.price.index', [
            'headers' => PriceCollection::$headers,
            'searches' => PriceCollection::$searches,
            'cities' => $cities,
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
        $cities = City::orderby('name', 'asc')->get();
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
        $cities = City::orderby('name', 'asc')->get();
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

    /**
     * Duplicate price 
     * 
     * @return Illuminate\Http\Response
     */
    public function duplicate(DuplicatePriceStoreRequest $request, $id)
    {
        $price = Price::withTrashed()->findOrFail($id);

        $price = Price::create([
            'departure_id' => $request->departure_id,
            'arrival_id' => $request->arrival_id,
            'currency_id' => $price->currency_id,
            'arrival_price' => $price->arrival_price,
            'departure_price' => $price->departure_price,
            'round_trip_price' => $price->round_trip_price,
            'price_per_mile' => $price->price_per_mile,
        ]);
        
        return response()->json([
            'message' => 'Price successfully duplicate!',
            'title' => 'Duplicate success'
        ]);
    }

    /**
     * copy all price from departure city
     * 
     * @return Illuminate\Http\Response
     */
    public function copyPrice(Request $request)
    {
        $prices = Price::where('departure_id', $request->departure_id)->get();

        foreach($prices as $price) {
            Price::create([
                'departure_id' => $request->copy_departure_id,
                'arrival_id' => $price->arrival_id,
                'currency_id' => $price->currency_id,
                'arrival_price' => $price->arrival_price,
                'departure_price' => $price->departure_price,
                'round_trip_price' => $price->round_trip_price,
                'price_per_mile' => $price->price_per_mile,
                'adult_one_way' => $price->adult_one_way,
                'adult_roundtrip' => $price->adult_roundtrip,
                'senior_one_way' => $price->senior_one_way,
                'senior_roundtrip' => $price->senior_roundtrip,
                'child_one_way' => $price->child_one_way,
                'child_roundtrip' => $price->child_roundtrip,
            ]);
        }
        
        return redirect()->route('price.index');
    }

}
