<?php

namespace App\Http\Controllers\Promotions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Promotions\PromotionStoreRequest;

use App\Actions\Promotions\PromotionCreateOrUpdateAction;
use Session;

class PromotionUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PromotionCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(PromotionStoreRequest $request, $id)
    {
    	$promotion = $this->action->execute($request, $id);
        
        Session::flash('success', 'Promotion updated successfully!');

    	return redirect()->back();
    }
}
