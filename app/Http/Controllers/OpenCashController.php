<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DailyItineraryFetch;
use App\Http\Resources\DailyItineraryCollection;
use Illuminate\Http\Request;

use App\Models\Cash;

class OpenCashController extends Controller
{
    /**
     * Show Trip index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {

        return view('pages.open-close-till.index', [
            //
        ]);
    }

    /**
     * store new cash for today
     * 
     * @return Illuminate\Http\Response
     */
    public function addCash(Request $request)
    {
        $user = auth()->user();
        $existing_cash = $user->cashes()->whereDate('created_at', now())->first();

        if(! $existing_cash) {
            $user->cashes()->create([
                'expiration_date' => now()->addDays(1),
                'cash' => $request->cash
            ]);
        } else {
            $existing_cash->update([
                'cash' => $request->cash
            ]);
        }

        return redirect()->route('ticket.index');
    }
}
