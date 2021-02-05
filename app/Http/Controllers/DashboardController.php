<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Show dasboard page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('dashboard');
    }
}
