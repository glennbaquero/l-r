<?php

namespace App\Http\Controllers\Cells;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\CellStoreRequest;

use App\Actions\Cells\CellCreateOrUpdateAction;
use Session;

class CellCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CellCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CellStoreRequest $request)
    {
    	$cell = $this->action->execute($request);
        Session::flash('success', 'Bus Cell successfully created!');
        return redirect()->route('cell.show', $cell->id);
    }
}
