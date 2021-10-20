<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PaymentDocumentCollection;
use App\Http\Fetch\PaymentDocumentFetch;

use App\Models\PaymentDocument;
use App\Models\User;

class PaymentDocumentController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(PaymentDocumentFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\PaymentDocumentMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.payment-document.index', [
            'headers' => PaymentDocumentCollection::$headers,
            'searches' => PaymentDocumentCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new PaymentDocumentCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::get();
        return view('pages.payment-document.create', [
            'payment_documents' => collect(PaymentDocument::getPaymentDocument()),
            'users' => $users,
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $document = PaymentDocument::withTrashed()->findOrFail($id);
        $users = User::get();

        return view('pages.payment-document.show', [
            'document' => $document,
            'payment_documents' => collect(PaymentDocument::getPaymentDocument()),
            'users' => $users,
        ]);
    }

}
