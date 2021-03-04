<?php

namespace App\Http\Controllers\Recommendations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Recommendations\RecommendationStoreRequest;

use App\Actions\Recommendations\RecommendationCreateOrUpdateAction;
use Session;

class RecommendationUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RecommendationCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(RecommendationStoreRequest $request, $id)
    {
    	$recommendation = $this->action->execute($request, $id);
        
        Session::flash('success', 'Recommendation updated successfully!');

    	return redirect()->back();
    }
}
