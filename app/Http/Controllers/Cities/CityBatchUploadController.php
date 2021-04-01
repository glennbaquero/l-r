<?php

namespace App\Http\Controllers\Cities;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Imports\CityImport;
use Excel;

use App\Http\Requests\Cities\CityBatchUploadRequest;

use App\Actions\Cities\CityCreateOrUpdateAction;
use Session;

class CityBatchUploadController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(CityCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(CityBatchUploadRequest $request)
    {
        Excel::import(new CityImport, $request->file('manifest'));
        Session::flash('success', 'Successfully uploaded the list of cities!');
        return redirect()->back();
    }
}
