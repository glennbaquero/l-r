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
use App\Models\Driver;

use PDF;
use Storage;

class ReportController extends Controller
{

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('App\Http\Middleware\ReportMiddleware');
    }

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
     * Show sales by departure and arrival index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByDepartureArrival()
    {   
        $types = TicketType::get();
        $cities = City::orderby('name', 'asc')->get();
        $genders = Driver::getGenderTypes();
        return view('pages.reports.sales.sales-by-departure-arrival', [
            'types' => $types,
            'cities' => $cities,
            'genders' => collect($genders),
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
        $cities = City::orderby('name', 'asc')->get();
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

    /**
     * Show income by route index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByTravel()
    {   
        $services = Service::get();
        $terminals = Office::get();
        $trips = Route::get();
        return view('pages.reports.sales.sales-by-travel', [
            'services' => $services,
            'terminals' => $terminals,
            'trips' => $trips,
        ]);
    }
   
    /**
     * Show sales by voucher index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByVoucher()
    {   
        return view('pages.reports.sales.sales-by-voucher', [
            //
        ]);
    }
   
    /**
     * Show sales by ticket index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByTicket()
    {   
        $ticket_statuses = [
            ['id' => 'Reserved', 'name' => 'Reserved'],
            ['id' => 'Paid', 'name' => 'Paid'],
        ];

        $payment_types = [
            ['id' => 'Cash', 'name' => 'Cash'],
            ['id' => 'Credit Card', 'name' => 'Credit Card'],
            ['id' => 'Others', 'name' => 'Others'],
        ];  

        return view('pages.reports.sales.sales-by-ticket', [
            'offices' => Office::get(),
            'users' => User::get(),
            'ticket_types' => TicketType::get(),
            'ticket_statuses' => collect($ticket_statuses),
            'payment_types' => collect($payment_types),
        ]);
    }
   
    /**
     * Show sales by credit card index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByCreditCard()
    {

        return view('pages.reports.sales.sales-by-credit-card', [
            'offices' => Office::get(),
        ]);
    }
   
    /**
     * Show sales by state index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByState()
    {
        $offices = Office::get();
        $states = [];
        $ticket_statuses = [
            ['id' => 'Reserved', 'name' => 'Reserved'],
            ['id' => 'Paid', 'name' => 'Paid'],
        ];

        $payment_types = [
            ['id' => 'Cash', 'name' => 'Cash'],
            ['id' => 'Credit Card', 'name' => 'Credit Card'],
            ['id' => 'Others', 'name' => 'Others'],
        ];  

        foreach (Office::get()->groupBy('state_name') as $key => $office) {
            if($key) {
                array_push($states, [
                    'id' => $key,
                    'name' => $key,
                ]);
            }
        }

        return view('pages.reports.sales.sales-by-state', [
            'states' => $states,
            'offices' => $offices,
            'ticket_types' => TicketType::get(),
            'states' => collect($states),
            'ticket_statuses' => collect($ticket_statuses),
            'payment_types' => collect($payment_types),
        ]);
    }
   
    /**
     * Show sales by agency index page
     * 
     * @return Illuminate\Http\Response
     */
    public function salesByAgency()
    {
        $terminal_lists = [];
        $terminals = Office::whereIn('office_type_id', [4])->get()->groupBy('departure_city_id');

        foreach ($terminals as $key => $terminal) {
            array_push($terminal_lists, [
                'id' => $key,
                'name' => $terminal[0]->name,
            ]);
        }

        $offices = Office::whereNotIn('office_type_id', [4])->get();

        return view('pages.reports.sales.sales-by-agency', [
            'terminals' => collect($terminal_lists),
            'offices' => $offices,
        ]);
    }
   
    /**
     * Show sales by account receivable index page
     * 
     * @return Illuminate\Http\Response
     */
    public function accountReceivable()
    {
        return view('pages.reports.account.receivable', [
            'offices' => Office::get(),
        ]);
    }

    /**
     * Show billing by tickets index page
     * 
     * @return Illuminate\Http\Response
     */
    public function billingByTickets()
    {
        return view('pages.reports.billing.billing-by-tickets', [
            //
        ]);
    }

    /**
     * Show billing by transaction index page
     * 
     * @return Illuminate\Http\Response
     */
    public function billingByTransaction()
    {
        return view('pages.reports.billing.billing-by-transactions', [
            //
        ]);
    }
   
}
