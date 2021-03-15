<?php

namespace App\Http\Controllers\Cells;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Buses\CellStoreRequest;

use App\Actions\Cells\CellCreateOrUpdateAction;
use Session;

class CellUpdateController extends Controller
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
    
    public function __invoke(CellStoreRequest $request, $id)
    {
    	$cell = $this->action->execute($request, $id);
        
        Session::flash('success', 'Cell updated successfully!');

    	return redirect()->back();
    }
}
