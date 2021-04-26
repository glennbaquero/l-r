<?php

namespace App\Http\Controllers\DiscountOptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountOptions\DiscountOptionStoreRequest;

use App\Actions\DiscountOptions\DiscountOptionCreateOrUpdateAction;
use Session;

class DiscountOptionCreateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(DiscountOptionCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(DiscountOptionStoreRequest $request)
    {
    	$item = $this->action->execute($request);
        Session::flash('success', 'Discount Option successfully created!');
        return redirect()->route('discount-option.show', $item->id);
    }
}
