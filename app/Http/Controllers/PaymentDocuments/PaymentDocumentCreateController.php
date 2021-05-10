<?php

namespace App\Http\Controllers\PaymentDocuments;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\PaymentDocuments\PaymentDocumentStoreRequest;

use App\Actions\PaymentDocuments\PaymentDocumentCreateOrUpdateAction;
use Session;

class PaymentDocumentCreateController extends Controller
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
    
    public function __invoke(PaymentDocumentStoreRequest $request)
    {
    	$document = $this->action->execute($request);
        Session::flash('success', 'Payment document successfully created!');
        return redirect()->route('payment-document.show', $document->id);
    }
}
