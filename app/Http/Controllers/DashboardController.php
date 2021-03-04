<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;

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
        return view('dashboard', [
        	'recommendations' => $recommendations
        ]);
    }
}
