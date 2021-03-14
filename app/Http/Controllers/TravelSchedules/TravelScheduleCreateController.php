<?php

namespace App\Http\Controllers\TravelSchedules;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Trips\TravelScheduleStoreRequest;

use App\Actions\TravelSchedules\TravelScheduleCreateOrUpdateAction;
use Session;

class TravelScheduleCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(TravelScheduleCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(TravelScheduleStoreRequest $request)
    {
    	$trip = $this->action->execute($request);
        Session::flash('success', 'Travel schedule successfully created!');
        return back();
    }
}
