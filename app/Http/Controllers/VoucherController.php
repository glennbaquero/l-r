<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\VoucherCollection;
use App\Http\Fetch\VoucherFetch;

use App\Models\Voucher;
use App\Models\Passenger;

class VoucherController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(VoucherFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\VoucherMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.voucher.index', [
            'headers' => collect(VoucherCollection::$headers),
            'headers_max_courtesy_ticket' => collect(VoucherCollection::$headers_max_courtesy_ticket),
            'headers_discount' => collect(VoucherCollection::$headers_discount),
            'searches' => VoucherCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {

        if(request()->input()['type_of_voucher'] == 'null') {
            request()->request->add(['type_of_voucher' => 'Amount']);
        }

        return new VoucherCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $passengers = Passenger::get();

        return view('pages.voucher.create', [
            'passengers' => $passengers,
            'types' => collect(Voucher::getType())
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $voucher = Voucher::withTrashed()->findOrFail($id);
        $passengers = Passenger::get();

        return view('pages.voucher.show', [
            'voucher' => $voucher,
            'passengers' => $passengers,
            'types' => collect(Voucher::getType())
        ]);
    }

}
