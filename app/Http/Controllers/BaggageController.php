<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\BaggageCollection;
use App\Http\Fetch\BaggageFetch;

use App\Models\Baggage;
use App\Models\Ticket;

class BaggageController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(BaggageFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\BaggageMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.baggage.index', [
            'headers' => BaggageCollection::$headers,
            'searches' => BaggageCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new BaggageCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $tickets = Ticket::with('passenger')->get();
        return view('pages.baggage.create', [
            'tickets' => $tickets
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $baggage = Baggage::withTrashed()->findOrFail($id);
        $tickets = Ticket::with('passenger')->get();

        return view('pages.baggage.show', [
            'baggage' => $baggage,
            'tickets' => $tickets
        ]);
    }

}
