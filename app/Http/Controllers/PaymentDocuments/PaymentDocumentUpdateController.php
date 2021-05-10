<?php

namespace App\Http\Controllers\PaymentDocuments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentDocuments\PaymentDocumentStoreRequest;

use App\Actions\PaymentDocuments\PaymentDocumentCreateOrUpdateAction;
use Session;

class PaymentDocumentUpdateController extends Controller
{
    protected $action;

    /**
     * Create new controller instance
     *
     * @return void
     */
    
    public function __construct(PaymentDocumentCreateOrUpdateAction $action)
    {
    	$this->action = $action;
    }

    /**
     * Handle the incoming request
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function __invoke(PaymentDocumentStoreRequest $request, $id)
    {
    	$document = $this->action->execute($request, $id);
        
        Session::flash('success', 'Payment document updated successfully!');

    	return redirect()->back();
    }
}
