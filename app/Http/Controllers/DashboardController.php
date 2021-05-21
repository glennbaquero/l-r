<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;
use App\Models\Office;
use App\Models\User;
use App\Models\Group;
use App\Models\City;
use App\Models\Reply;

use Illuminate\Notifications\DatabaseNotification;

use App\Notifications\NotifyUser;

class DashboardController extends Controller
{
    /**
     * Show dasboard page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
    	$recommendations = Recommendation::get();
        $offices = Office::whereIn('office_type_id', [1, 2])->get();

        return view('dashboard', [
        	'recommendations' => $recommendations,
            'offices' => $offices,

        ]);
    }

    /**
     * Update the office of the current user logged in
     * 
     * @return Illuminate\Http\Response
     */
    public function update(Request $request)
    {

        $user = auth()->user();

        $user->update([
            'office_id' => $request->office_id
        ]);

        return response()->json([
            'message' => 'Office succesfully update',
            'success' => true
        ]);
    }
}
