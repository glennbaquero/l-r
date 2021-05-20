<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;
use App\Models\Office;

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

        return Response()->json([
            'message' => 'Office succesfully update',
            'success' => true
        ]);
    }
}
