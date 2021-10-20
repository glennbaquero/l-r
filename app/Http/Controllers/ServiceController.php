<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\ServiceCollection;
use App\Http\Fetch\ServiceFetch;

use App\Models\Service;

class ServiceController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(ServiceFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\ServiceMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.service.index', [
            'headers' => ServiceCollection::$headers,
            'searches' => ServiceCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new ServiceCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.service.create', [
            //
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $service = Service::withTrashed()->findOrFail($id);

        return view('pages.service.show', [
            'service' => $service
        ]);
    }

}
