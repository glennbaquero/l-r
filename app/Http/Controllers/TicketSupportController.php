<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TicketSupportCollection;
use App\Http\Fetch\TicketSupportFetch;

use App\Models\User;
use App\Models\Ticket;

class TicketSupportController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TicketSupportFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\TicketSupportMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.ticket-support.index', [
            'headers' => TicketSupportCollection::$headers,
            'searches' => TicketSupportCollection::$searches,
            'users' => User::get(),
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new TicketSupportCollection($this->fetch->execute(request()->input()));
    }

}
