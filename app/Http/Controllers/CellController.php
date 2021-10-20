<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CellCollection;
use App\Http\Fetch\CellFetch;

use App\Models\Cell;
use App\Models\Country;

class CellController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(CellFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\CellMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.cell.index', [
            'headers' => CellCollection::$headers,
            'searches' => CellCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new CellCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.cell.create', [
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
        $cell = Cell::withTrashed()->findOrFail($id);
        $countries = Country::get();

        return view('pages.cell.show', [
            'cell' => $cell,
        ]);
    }

}
