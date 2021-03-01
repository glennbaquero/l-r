<?php

namespace App\Http\Controllers\Printers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Printers\PrinterStoreRequest;

use App\Actions\Printers\PrinterCreateOrUpdateAction;
use Session;

class PrinterUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PrinterCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(PrinterStoreRequest $request, $id)
    {
    	$printer = $this->action->execute($request, $id);
        
        Session::flash('success', 'Printer updated successfully!');

    	return redirect()->back();
    }
}
