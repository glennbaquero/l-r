<?php

namespace App\Http\Controllers;

use App\Http\Resources\OpenCashCollection;
use App\Http\Fetch\OpenCashFetch;

use Illuminate\Http\Request;

use App\Models\Cash;

class OpenCashController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(OpenCashFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\OpenCashMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show Open cash till index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.open-close-till.index', [
            'headers' => OpenCashCollection::$headers,
            'searches' => OpenCashCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new OpenCashCollection($this->fetch->execute(request()->input()));
    }

    /**
     * store new cash for today
     * 
     * @return Illuminate\Http\Response
     */
    public function addCash(Request $request)
    {
        $user = auth()->user();
        $existing_cash = $user->cashes()->where('office_id', $user->office_id)->whereDate('created_at', now())->first();

        if(! $existing_cash) {
            $user->cashes()->create([
                'expiration_date' => now()->addDays(1),
                'cash' => $request->cash,
                'office_id' => $user->office_id
            ]);
        } 
        // else {
        //     $existing_cash->update([
        //         'cash' => $request->cash
        //     ]);
        // }

        return redirect()->route('ticket.index');
    }
}
