<?php

namespace App\Http\Controllers\Prices;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\PriceImport;
use Excel;

use App\Http\Requests\Prices\PriceBatchUploadRequest;

use App\Actions\Prices\PriceCreateOrUpdateAction;
use Session;

class PriceBatchUploadController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PriceCreateOrUpdateAction $action)
    {
        $this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(PriceBatchUploadRequest $request)
    {
        Excel::import(new PriceImport, $request->file('manifest'));
        Session::flash('success', 'Successfully uploaded the list of price! Please update your newly added city for their respective pin in the map.');
        return redirect()->back();
    }
}
