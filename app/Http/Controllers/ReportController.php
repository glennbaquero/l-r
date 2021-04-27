<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DailyItineraryFetch;
use App\Http\Resources\DailyItineraryCollection;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\OfficeType;
use App\Models\User;
use App\Models\Ticket;

use PDF;
use Storage;

class ReportController extends Controller
{
    /**
     * Show sales by user index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByUser()
    {

        return view('pages.reports.sales.sales-by-user', [
            'offices' => Office::get(),
            'office_types' => OfficeType::get(),
            'users' => User::get(),
        ]);
    }
   
}
