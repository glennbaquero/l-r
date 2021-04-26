<?php

namespace App\Http\Controllers\Discounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discounts\DiscountStoreRequest;

use App\Actions\Discounts\DiscountCreateOrUpdateAction;
use Session;

class DiscountUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(DiscountCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(DiscountStoreRequest $request, $id)
    {
    	$discount = $this->action->execute($request, $id);
        
        Session::flash('success', 'Discount updated successfully!');

    	return redirect()->back();
    }
}
