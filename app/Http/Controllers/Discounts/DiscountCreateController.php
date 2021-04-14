<?php

namespace App\Http\Controllers\Discounts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Discounts\DiscountStoreRequest;

use App\Actions\Discounts\DiscountCreateOrUpdateAction;
use Session;

class DiscountCreateController extends Controller
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
    
    public function __invoke(DiscountStoreRequest $request)
    {
    	$discount = $this->action->execute($request);
        Session::flash('success', 'Discount successfully created!');
        return redirect()->route('discount.show', $discount->id);
    }
}
