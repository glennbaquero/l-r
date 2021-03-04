<?php

namespace App\Http\Controllers\Recommendations;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Recommendations\RecommendationDeleteAction;

class RecommendationDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(RecommendationDeleteAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(Request $request, $id)
    {
    	$recommendation = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
