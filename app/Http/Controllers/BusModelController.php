<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\BusModelCollection;
use App\Http\Fetch\BusModelFetch;

use App\Models\Cell;
use App\Models\BusModel;

class BusModelController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(BusModelFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\BusModelMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.bus-model.index', [
            'headers' => BusModelCollection::$headers,
            'searches' => BusModelCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new BusModelCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.bus-model.create', [
            'cells' => Cell::get()
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = BusModel::withTrashed()->findOrFail($id);
        $row_list = [];

        foreach ($model->bus_rows as $row) {
            $row_list[] = $row->bus_columns;

            // array_push()
        }

        $model['columnsCellType'] = $row_list;

        return view('pages.bus-model.show', [
            'model' => $model,
            'cells' => Cell::get()
        ]);
    }

}
