<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Recommendation;
use App\Models\Office;
use App\Models\Route;
use App\Models\Ticket;

use App\Http\Resources\TicketCollection;

class DashboardController extends Controller
{

    public function __construct() 
    {
        $this->middleware('App\Http\Middleware\DashboardMiddleware', ['only' => ['index']]);
        $this->middleware('App\Http\Middleware\DriverAuthMiddleware', ['only' => ['scanQR', 'driverDashboard']]);
    }

    /**
     * Show dasboard page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
    	$recommendations = Recommendation::get();
        $offices = Office::where('office_type_id', 4)->get();
        $routes = Route::get();
        $data_total_revenue = [];
        $data_label_per_revenue = [];
        $data_bgcolor_per_revenue = [];

        foreach ($routes as $key => $route) {
            $total_revenue = 0;
            foreach ($route->trips as $trip) {
                $total_revenue += $trip->tickets->sum('total_sale');
            }

            $bg_color = '#' . str_pad(dechex(mt_rand(0, 0xFFFFFF)), 6, '0', STR_PAD_LEFT);

            array_push($data_total_revenue, $total_revenue);
            array_push($data_label_per_revenue, $route->name);
            array_push($data_bgcolor_per_revenue, $bg_color);
        }

        $months = [];
        $per_month_revenue = [];

        for ($m=1; $m<=12; $m++) {
            $month_name = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $months[] = $month_name;

            $revenue = Ticket::whereMonth('purchase_date', $m)->sum('total_sale');
            array_push($per_month_revenue, $revenue);
        }

        $years = array_combine(range(date("Y"), 2020), range(date("Y"), 2020));
        array_unshift($years,"All");

        return view('dashboard', [
        	'recommendations' => $recommendations,
            'offices' => $offices,
            'data_total_revenue' => collect($data_total_revenue),
            'data_label_per_revenue' => collect($data_label_per_revenue),
            'data_bgcolor_per_revenue' => collect($data_bgcolor_per_revenue),
            'months' => collect($months),
            'per_month_revenue' => collect($per_month_revenue),
            'years' => collect($years),
        ]);
    }

    /**
     * Show scanning of QR
     * 
     * @return Illuminate\Http\Response
     */
    public function scanQR()
    {
        return view('pages.qr.scanner', [
            //
        ]);
    }

    /**
     * Show scanning of QR
     * 
     * @return Illuminate\Http\Response
     */
    public function driverDashboard()
    {
        return view('pages.qr.driver-dashboard', [
            'headers' => TicketCollection::$driver_passenger_list,
            'searches' => TicketCollection::$searches,
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

    /**
     * Update the line graph
     * 
     * @return Illuminate\Http\Response
     */
    public function updateLineGraph(Request $request)
    {
        $months = [];
        $per_month_revenue = [];

        for ($m=1; $m<=12; $m++) {
            $month_name = date('F', mktime(0,0,0,$m, 1, date('Y')));
            $months[] = $month_name;

            switch ($request->type) {
                case 'yearly':
                    if($request->year != 'All') {
                        $revenue = Ticket::whereMonth('purchase_date', $m)->whereYear('purchase_date', $request->year)->sum('total_sale');
                    } else {
                        $revenue = Ticket::whereMonth('purchase_date', $m)->sum('total_sale');
                    }
                    break;
                
                case 'date_range':
                    $revenue = Ticket::whereBetween('purchase_date', [$request->from, $request->to])->whereMonth('purchase_date', $m)->sum('total_sale');
                    break;
                
                default:
                    // code...
                    break;
            }
            

            array_push($per_month_revenue, $revenue);
        }

        return response()->json([
            'per_month_revenue' => collect($per_month_revenue),
            'months' => collect($months),
        ]);
    }
}
