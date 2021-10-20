<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\AccountPayableCollection;
use App\Http\Fetch\AccountPayableFetch;

use App\Models\AccountPayable;

class AccountPayableController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(AccountPayableFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\AccountPayableMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.account-payable.index', [
            'headers' => AccountPayableCollection::$headers,
            'searches' => AccountPayableCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new AccountPayableCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.account-payable.create', [
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
        $item = AccountPayable::withTrashed()->findOrFail($id);
        return view('pages.account-payable.show', [
            'item' => $item,
        ]);
    }

}
