<?php

namespace App\Http\Controllers\DiscountOptions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DiscountOptions\DiscountOptionStoreRequest;

use App\Actions\DiscountOptions\DiscountOptionCreateOrUpdateAction;
use Session;

class DiscountOptionUpdateController extends Controller
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
    
    public function __invoke(DiscountOptionStoreRequest $request, $id)
    {
    	$item = $this->action->execute($request, $id);
        
        Session::flash('success', 'Discount Option updated successfully!');

    	return redirect()->back();
    }
}
