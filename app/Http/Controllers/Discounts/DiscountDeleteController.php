<?php

namespace App\Http\Controllers\Discounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Actions\Discounts\DiscountDeleteAction;

class DiscountDeleteController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(DiscountDeleteAction $action)
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
    	$discount = $this->action->execute($id);

    	return response()->json([
    		'message' => 'Update success'
    	]);
    }
}
