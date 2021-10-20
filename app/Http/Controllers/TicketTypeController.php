<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TicketTypeCollection;
use App\Http\Fetch\TicketTypeFetch;

use App\Models\TicketType;
use App\Models\DocumentType;
use App\Models\Dependence;

class TicketTypeController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TicketTypeFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\TicketTypeMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.ticket-type.index', [
            'headers' => TicketTypeCollection::$headers,
            'searches' => TicketTypeCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new TicketTypeCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $documents = DocumentType::get();
        $dependencies = Dependence::get();

        return view('pages.ticket-type.create', [
            'documents' => $documents,
            'dependencies' => $dependencies
        ]);
    }

    /**
     * Show ticket-types view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $documents = DocumentType::get();
        $dependencies = Dependence::get();
        $ticket_type = TicketType::withTrashed()->findOrFail($id);
        $ticket_type['selectedIds'] = $ticket_type->dependencies()->pluck('dependence_id');


        return view('pages.ticket-type.show', [
            'ticket_type' => $ticket_type,
            'documents' => $documents,
            'dependencies' => $dependencies
        ]);
    }

}
