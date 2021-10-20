<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CompanyCollection;
use App\Http\Fetch\CompanyFetch;

use App\Models\Company;

class CompanyController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(CompanyFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\CompanyMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.company.index', [
            'headers' => CompanyCollection::$headers,
            'searches' => CompanyCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new CompanyCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.company.create', [
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
        $company = Company::withTrashed()->findOrFail($id);

        return view('pages.company.show', [
            'company' => $company
        ]);
    }

}
