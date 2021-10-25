<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\BusCollection;
use App\Http\Fetch\BusFetch;

use App\Models\BusModel;
use App\Models\Bus;

class BusController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(BusFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\BusMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bus.index', [
            'headers' => BusCollection::$headers,
            'searches' => BusCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new BusCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $types = [ 
            [
                'name' => 'Carga'
            ],
            [
                'name' => 'Tickets'
            ]
        ];
        return view('pages.bus.create', [
            'models' => BusModel::get(),
            'types' => $types,

        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $bus = Bus::withTrashed()->findOrFail($id);
        $types = [ 
            [
                'name' => 'Carga'
            ],
            [
                'name' => 'Tickets'
            ]
        ];

        return view('pages.bus.show', [
            'bus' => $bus,
            'models' => BusModel::get(),
            'types' => $types,
        ]);
    }

}
