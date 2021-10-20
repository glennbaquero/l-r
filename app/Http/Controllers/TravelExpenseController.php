<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TravelExpenseCollection;
use App\Http\Fetch\TravelExpenseFetch;

use App\Models\Route;
use App\Models\City;
use App\Models\Expense;
use App\Models\Trip;

class TravelExpenseController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TravelExpenseFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\TravelExpenseMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        
        return view('pages.travel-expense.index', [
            'headers' => TravelExpenseCollection::$headers,
            'searches' => TravelExpenseCollection::$searches,
            'cities' => City::orderby('name', 'asc')->get(),
            'routes' => Route::get()
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new TravelExpenseCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create($trip_id)
    {
        return view('pages.travel-expense.create', [
            'trip' => Trip::withTrashed()->findOrFail($trip_id)
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $trip = Trip::withTrashed()->findOrFail($id);
        $expenses = $trip->expenses;

        $dollar['ingresos'] = '0.00';
        $dollar['gastos'] = number_format($trip->expenses()->where('is_currency_mex', 0)->sum('amount'), 2, '.', ',');
        $dollar['balance'] = $dollar['ingresos'] - $dollar['gastos'];

        $mex['ingresos'] = '0.00';
        $mex['gastos'] = number_format($trip->expenses()->where('is_currency_mex', 1)->sum('amount'), 2, '.', ',');
        $mex['balance'] = number_format(($mex['ingresos'] - $mex['gastos']), 2, '.', ',');

        $total['ingresos'] = number_format(($dollar['ingresos'] + $mex['ingresos']), 2, '.', ',');
        $total['gastos'] = number_format(($dollar['gastos'] + $mex['gastos']), 2, '.', ',');
        $total['balance'] = number_format(($dollar['balance'] + $mex['balance']), 2, '.', ',');

        return view('pages.travel-expense.show', [
            'trip' => $trip,
            'expenses' => $expenses,

            'dollar' => $dollar,
            'mex' => $mex,
            'total' => $total,
        ]);
    }

}
