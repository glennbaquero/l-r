<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Resources\TicketCollection;
use App\Http\Fetch\TicketFetch;

use App\Models\PaymentDocument;
use App\Models\AccountReceivable;
use App\Models\Office;

class AccountReceivableController extends Controller
{    
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TicketFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\AccountReceivableMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $offices = Office::get();
        $states = [];
        foreach (Office::get()->groupBy('state_name') as $key => $office) {
            if($key) {
                array_push($states, [
                    'id' => $key,
                    'name' => $key,
                ]);
            }
        }

        return view('pages.accounts-receivable.create', [
            'headers' => TicketCollection::$account_receivable_headers,
            'searches' => TicketCollection::$searches,
            'payment_documents' => PaymentDocument::get(),
            'states' => collect($states),
            'offices' => $offices,
        ]);
    }

}
