<?php

namespace App\Http\Controllers\Promotions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Promotions\PromotionDeleteAction;

class PromotionDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PromotionDeleteAction $action)
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
    	$promotion = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
