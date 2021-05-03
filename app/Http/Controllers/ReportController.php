<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DailyItineraryFetch;
use App\Http\Resources\DailyItineraryCollection;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\OfficeType;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Cash;
use App\Models\Trip;
use App\Models\TicketType;
use App\Models\City;
use App\Models\Service;
use App\Models\Bus;
use App\Models\Route;

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

    /**
     * Show daily till closure index page
     * 
     * @return Illuminate\Http\Response
     */
    public function dailyTillClosure()
    {

        return view('pages.reports.closure-of-till.daily-till-closure', [
            'offices' => Office::get(),
            'office_types' => OfficeType::get(),
            'users' => User::get(),
            'cash' => Cash::get(),
        ]);
    }

    /**
     * Show daily till report terminal index page
     * 
     * @return Illuminate\Http\Response
     */
    public function dailyTillReportTerminal()
    {

        return view('pages.reports.closure-of-till.daily-till-report-terminal', [
            'offices' => Office::get(),
        ]);
    }

    /**
     * Show daily till report terminal index page
     * 
     * @return Illuminate\Http\Response
     */
    public function myDailyClosure()
    {   
        $cash_registers = auth()->user()->cashes;
        return view('pages.reports.closure-of-till.my-daily-closure', [
            'cash_registers' => $cash_registers,
        ]);
    }

    /**
     * Show reservartion per route index page
     * 
     * @return Illuminate\Http\Response
     */
    public function reservationPerRoute()
    {   
        $trips = Trip::get();
        return view('pages.reports.route.reservation-per-route', [
            'trips' => $trips,
        ]);
    }

    /**
     * Show price per route index page
     * 
     * @return Illuminate\Http\Response
     */
    public function pricePerRoute()
    {   
        $types = TicketType::get();
        $cities = City::get();
        return view('pages.reports.route.price-per-route', [
            'types' => $types,
            'cities' => $cities,
        ]);
    }

    /**
     * Show income by route index page
     * 
     * @return Illuminate\Http\Response
     */
    public function incomeByRoute()
    {   
        $services = Service::get();
        $buses = Bus::get();
        $trips = Route::get();
        return view('pages.reports.route.income-by-route', [
            'services' => $services,
            'buses' => $buses,
            'trips' => $trips,
        ]);
    }
   
}
