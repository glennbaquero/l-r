<?php

namespace App\Http\Controllers\Reports;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\OfficeType;
use App\Models\User;
use App\Models\Ticket;
use App\Models\Cash;
use App\Models\Trip;
use App\Models\Price;
use App\Models\TicketType;
use App\Models\City;
use App\Models\Service;
use App\Models\Bus;
use App\Models\Route;
use App\Models\Voucher;

use PDF;
use Storage;


class PrintController extends Controller
{
    /**
     * Handle the sales by user print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByUser($seller_ids, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('created_at', $start_date)->whereIn('seller_id', json_decode($seller_ids))->get();
        } else {
            $tickets = Ticket::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->whereIn('seller_id', json_decode($seller_ids))->get();
        }

        $users = [];
        $ticket_lists = [];

        foreach ($tickets as $key => $ticket) {
            if(!in_array($ticket->seller->fullname, $users)) {
                array_push($users, $ticket->seller->fullname);
            }

            if(!collect($ticket_lists)->contains('seller_id', $ticket->seller_id)) {
                array_push($ticket_lists, [
                    'seller_id' => $ticket->seller_id,
                    'ticket' => $ticket
                ]);
            }   
        }

        $tickets = $ticket_lists;

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-user', compact('tickets', 'users', 'start_date', 'end_date', 'date_type'));
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;

        return $pdf->download('report.pdf');
    }

    /**
     * Handle the daily till closure print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printDailyTillClosure($seller_id, $date_type, $start_date, $end_date, $cash_box)
    {
        $tickets = Ticket::where('seller_id', $seller_id)->get();
        $cash_register = Cash::where('user_id', $seller_id)->get();
        $has_many_cash_register = true;

        if($cash_box != 'null') {
            $cash_register = Cash::findOrFail($cash_box);
            $tickets = Ticket::whereTime('created_at', $cash_register->created_at)->where('seller_id', $seller_id)->get();
            $has_many_cash_register = false;
        }


        $seller = User::find($seller_id);
        $ticket_lists = [];

        // foreach ($tickets as $key => $ticket) {
        //     if(!in_array($ticket->seller->fullname, $users)) {
        //         array_push($users, $ticket->seller->fullname);
        //     }

        //     if(!collect($ticket_lists)->contains('seller_id', $ticket->seller_id)) {
        //         array_push($ticket_lists, [
        //             'seller_id' => $ticket->seller_id,
        //             'ticket' => $ticket
        //         ]);
        //     }   
        // }

        // $tickets = $ticket_lists;

        $pdf = PDF::loadView('pages.reports.pdf.daily-till-closure', compact('tickets', 'seller', 'start_date', 'end_date', 'date_type', 'cash_register', 'has_many_cash_register'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the daily till closure report terminal print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printDailyTillReportTerminal($office_id, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('created_at', $start_date)->whereHas('seller', function($seller) use($office_id) {
                $seller->where('office_id', $office_id);
            })->get();
        } else {
            $tickets = Ticket::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->whereHas('seller', function($seller) use($office_id) {
                $seller->where('office_id', $office_id);
            })->get();
        }

        $office = Office::find($office_id);

        $users = $office->users;

        $pdf = PDF::loadView('pages.reports.pdf.daily-till-report-terminal', compact('tickets', 'start_date', 'end_date', 'date_type', 'office', 'users'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the my daily till closure report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printMyDailyTillClosure($date_type, $start_date, $end_date, $cash_register)
    {
        $tickets = null;
        $user = auth()->user();
        $office = $user->office->name;
        $has_many_cash_register = true;

        if($cash_register != 'null') {
            $cash_register = Cash::findOrFail($cash_register);

            if($date_type == 'false' || !$date_type) {
                $tickets = Ticket::whereTime('created_at', $cash_register->created_at)->whereDate('created_at', $start_date)->where('seller_id', $user->id)->get();
            } else {
                $tickets = Ticket::whereTime('created_at', $cash_register->created_at)->where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->where('seller_id', $user->id)->get();
            }
            $has_many_cash_register = false;
        }

        $pdf = PDF::loadView('pages.reports.pdf.my-daily-closure', compact('tickets', 'start_date', 'end_date', 'date_type', 'office', 'user', 'has_many_cash_register', 'cash_register'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the reservation per route report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printReservationPerRoute($date_type, $start_date, $end_date, $trip_ids)
    {
        $trip_ids = json_decode($trip_ids);
        $route_ids = Trip::whereIn('id', $trip_ids)->pluck('route_id');
        $travels = implode(',', Trip::whereIn('id', $trip_ids)->pluck('alias_route')->toArray());
        
        $trip_ids = Trip::whereIn('route_id', $route_ids)->pluck('id');

        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('created_at', $start_date)->whereIn('trip_id', $trip_ids)->get();
        } else {
            $tickets = Ticket::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->whereIn('trip_id', $trip_ids)->get();
        }
        
        $pdf = PDF::loadView('pages.reports.pdf.reservation-per-route', compact('tickets', 'start_date', 'end_date', 'date_type', 'travels'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the price per route report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printPricePerRoute($city_id, $type_ids)
    {
        $types = TicketType::whereIn('id', json_decode($type_ids))->get();
        $headers = TicketType::whereIn('id', json_decode($type_ids))->pluck('name');

        $prices = Price::where('departure_id', $city_id)->get();
        $city = City::find($city_id)->name;

        foreach ($types as $key => $type) {
           foreach ($prices as $price) {
                switch($type->discount_type) {
                    case 'Percent':
                        $value = $type->discount / 100; 
                        $type['arrival_price'] = $value * $price->arrival_price; 
                        $type['roundtrip_price'] = ($value * $price->round_trip_price) * 2; 
                        break;

                    default: 
                        $value = $type->discount; 
                        $type['arrival_price'] = $price->arrival_price - $value; 
                        $type['roundtrip_price'] = ($price->round_trip_price - $value) * 2; 
                        break;
                }
                $type['price'] = $price;
           }
        }
        // dd($types);
        $ticket_type = implode(',', $headers->toArray());
        

        $pdf = PDF::loadView('pages.reports.pdf.price-per-route', compact('types', 'headers', 'ticket_type', 'city', 'prices'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the income by route report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printIncomeByRoute($route_ids, $bus_ids, $service_ids, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $trips = Trip::whereDate('date', $start_date)->whereIn('route_id', json_decode($route_ids))->whereIn('service_id', json_decode($service_ids))->whereIn('bus_id', json_decode($bus_ids))->get();
        } else {
            $trips = Trip::where('date', '>=', $start_date)->where('date', '<=', $end_date)->whereIn('route_id', json_decode($route_ids))->whereIn('service_id', json_decode($service_ids))->whereIn('bus_id', json_decode($bus_ids))->get();
        }

        $bus = Bus::whereIn('id', json_decode($bus_ids))->pluck('name');
        $bus = implode(',', $bus->toArray());
        $service = Service::whereIn('id', json_decode($service_ids))->pluck('name');
        $service = implode(',', $service->toArray());
        $route = Route::whereIn('id', json_decode($route_ids))->pluck('name');
        $route = implode(',', $route->toArray());

        $total_passengers = 0;
        $total_revenue = 0;

        foreach ($trips as $key => $trip) {
            $total_passengers += $trip->tickets()->count();
            $total_revenue += $trip->tickets->sum('total_sale');
        }

        $pdf = PDF::loadView('pages.reports.pdf.income-by-route', compact('trips', 'bus', 'service', 'route', 'date_type', 'start_date', 'end_date', 'total_passengers', 'total_revenue'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the sales by departure arrival report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByDepartureArrival($departure_ids, $arrival_ids, $type_ids, $genders, $date_type, $start_date, $end_date)
    {
        $tickets = Ticket::whereHas('trip', function($trip) use($date_type, $start_date, $end_date) {
            if($date_type == 'false' || !$date_type) {
                $trip->whereDate('date', $start_date);
            } else {
                $trip->where('date', '>=', $start_date)->where('date', '<=', $end_date);
            }
        })->whereIn('departure_id', json_decode($departure_ids))->whereIn('arrival_id', json_decode($arrival_ids))->whereHas('passenger', function($passenger) use($genders) {
            $passenger->whereIn('gender', json_decode($genders));
        })->get()->groupBy(['departure_id', 'arrival_id']);
        

        $new_ticket_list = [];
        $overall_total = 0;

        foreach($tickets as $departure => $ticketDeparture) {
            foreach ($ticketDeparture as $arrival => $ticketArrival) {
                $male = 0;
                $female = 0;
                $total_sales = 0;
                foreach($ticketArrival as $ticket) {
                    $total_sales += $ticket->total_sale;
                    $overall_total += $ticket->total_sale;

                    switch($ticket->passenger_gender) {
                        case 'Male':
                            if(in_array('Male', json_decode($genders))) {
                                $male += 1;    
                            }
                            break;

                        case 'Female':
                            if(in_array('Female', json_decode($genders))) {
                                $female += 1;
                            }
                            break;
                    }
                }

                array_push($new_ticket_list, [
                    'departure' => City::find($departure)->name,
                    'arrival' => City::find($arrival)->name,
                    'male' => $male,
                    'female' => $female,
                    'total' => $male + $female,
                    'total_sales' => number_format($total_sales, 2, '.', ',')
                ]);
            }
        }

        $overall_total = number_format($overall_total, 2, '.', ',');

        $departure = City::whereIn('id', json_decode($departure_ids))->pluck('name');
        $departure = implode(',', $departure->toArray());
        $arrival = City::whereIn('id', json_decode($arrival_ids))->pluck('name');
        $arrival = implode(',', $arrival->toArray());
        $type = TicketType::whereIn('id', json_decode($type_ids))->pluck('name');
        $type = implode(',', $type->toArray());
        $gender = implode(',', json_decode($genders));

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-departure-arrival', compact('new_ticket_list', 'departure', 'arrival', 'type', 'gender', 'date_type', 'start_date', 'end_date', 'overall_total'));
        $pdf->setPaper('A4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the sales by travel report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByTravel($trip_ids, $terminal_ids, $service_ids, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('created_at', $start_date)->whereHas('seller', function($seller) use($terminal_ids) {
                $seller->whereIn('office_id', json_decode($terminal_ids));
            })->whereHas('trip', function($trip) use($service_ids, $trip_ids) {
                $trip->whereIn('service_id', json_decode($service_ids))->whereIn('route_id', json_decode($trip_ids));
            })->get()->groupBy('trip_id');
        } else {
            $tickets = Ticket::where('created_at', '>=', $start_date)->where('created_at', '<=', $end_date)->whereHas('seller', function($seller) use($terminal_ids) {
                $seller->whereIn('office_id', json_decode($terminal_ids));
            })->whereHas('trip', function($trip) use($service_ids, $trip_ids) {
                $trip->whereIn('service_id', json_decode($service_ids))->whereIn('route_id', json_decode($trip_ids));
            })->get()->groupBy('trip_id');
        }

       
        $lists = [];
        $total_passenger = 0;
        $total_seat = 0;
        $total_revenue = 0;

        foreach ($tickets as $key => $group_by_trip) {
            $total_passenger += $group_by_trip->count();
            $bus_rows = $group_by_trip[0]->trip->bus->bus_model->bus_rows;
            $group_by_trip[0]['total_seats'] = 0;
            $total_revenue += $group_by_trip->sum('total_sale');
            foreach ($bus_rows as $row) {
               $group_by_trip[0]['total_seats'] += $row->bus_columns()->whereNotNull('label')->count();
               $total_seat += $row->bus_columns()->whereNotNull('label')->count();
            }

            array_push($lists, $group_by_trip[0]);

        }

        $tickets = $lists;


        $service = Service::whereIn('id', json_decode($service_ids))->pluck('name');
        $service = implode(',', $service->toArray());
        $trip = Route::whereIn('id', json_decode($trip_ids))->pluck('name');
        $trip = implode(',', $trip->toArray());
        $office = Office::whereIn('id', json_decode($terminal_ids))->pluck('name');
        $office = implode(',', $office->toArray());

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-travel', compact('tickets', 'service', 'trip', 'office', 'date_type', 'start_date', 'end_date', 'total_passenger', 'total_seat', 'total_revenue'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }


    /**
     * Handle the income by route report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByVoucher($is_open)
    {
        $ticket_that_have_voucher = Ticket::whereNotNull('voucher_code')->pluck('voucher_code');
        if($is_open && $is_open == 'true') {
            $items = Voucher::whereIn('code', $ticket_that_have_voucher)->get();
        } else {
            $items = Ticket::whereNotNull('voucher_code')->get();
        }
        $pdf = PDF::loadView('pages.reports.pdf.sales-by-voucher', compact('items', 'is_open'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the sales by ticket report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByTicket($office_ids, $user_ids, $ticket_type_ids, $ticket_status, $payment_type, $date_type, $start_date, $end_date)
    {
        $office_ids = json_decode($office_ids);
        $user_ids = json_decode($user_ids);
        $ticket_type_ids = json_decode($ticket_type_ids);
        $ticket_status = json_decode($ticket_status);
        $payment_type = json_decode($payment_type);

        $users = User::whereIn('id', $user_ids)->whereHas('tickets', function($tickets) use($ticket_type_ids, $ticket_status, $payment_type, $date_type, $start_date, $end_date) {
                $tickets->whereIn('payment_status', $ticket_status)->whereIn('payment_method', $payment_type)->whereHas('passenger', function($passenger) use($ticket_type_ids) {
                    $passenger->whereIn('ticket_type_id', $ticket_type_ids);
                })->whereHas('trip', function($trip) use($date_type, $start_date, $end_date) {
                    if($date_type == 'false' || !$date_type) {
                        $trip->whereDate('date', $start_date);
                    } else {
                        $trip->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                    }
                });
        })->get();      


        $user = User::whereIn('id', $user_ids)->get()->map(function($user) {
            return [
                'fullname'  => $user->fullname
            ];
        })->pluck('fullname');
        $user = implode(', ', $user->toArray());
        $office = Office::whereIn('id', $office_ids)->pluck('name');
        $office = implode(', ', $office->toArray());
        $ticket_type = TicketType::whereIn('id', $ticket_type_ids)->pluck('name');
        $ticket_type = implode(', ', $ticket_type->toArray());
        $payment_type = implode(', ', $payment_type);
        $ticket_status = implode(', ', $ticket_status);

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-ticket', compact('users', 'user', 'office', 'ticket_type', 'payment_type', 'ticket_status', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }


    /**
     * Handle the sales by credit card report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByCreditCard($is_concept, $office_id, $date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('purchase_date', $start_date);
        } else {
            $tickets = Ticket::where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date);
        }

        if($is_concept == 'true' || $is_concept) {
            $tickets = $tickets->whereHas('seller', function($seller) use($office_id) {
                $seller->where('office_id', $office_id);
            })->get();

            $office = Office::find($office_id)->name;
        } else {
            $tickets = $tickets->get();
        }

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-credit-card', compact('is_concept', 'office', 'tickets', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }


    /**
     * Handle the sales by state report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByState($state, $office_ids, $ticket_type_ids, $ticket_status, $payment_type, $date_type, $start_date, $end_date)
    {
        $office_ids = json_decode($office_ids);
        $ticket_type_ids = json_decode($ticket_type_ids);
        $ticket_status = json_decode($ticket_status);
        $payment_type = json_decode($payment_type);

        $users = User::whereIn('office_id', $office_ids)->whereHas('tickets', function($tickets) use($ticket_type_ids, $ticket_status, $payment_type, $date_type, $start_date, $end_date) {
                $tickets->whereIn('payment_status', $ticket_status)->whereIn('payment_method', $payment_type)->whereHas('passenger', function($passenger) use($ticket_type_ids) {
                    $passenger->whereIn('ticket_type_id', $ticket_type_ids);
                })->whereHas('trip', function($trip) use($date_type, $start_date, $end_date) {
                    if($date_type == 'false' || !$date_type) {
                        $trip->whereDate('date', $start_date);
                    } else {
                        $trip->where('date', '>=', $start_date)->where('date', '<=', $end_date);
                    }
                });
        })->get();      

        $office = Office::whereIn('id', $office_ids)->pluck('name');
        $office = implode(', ', $office->toArray());
        $ticket_type = TicketType::whereIn('id', $ticket_type_ids)->pluck('name');
        $ticket_type = implode(', ', $ticket_type->toArray());
        $payment_type = implode(', ', $payment_type);
        $ticket_status = implode(', ', $ticket_status);
        $pdf = PDF::loadView('pages.reports.pdf.sales-by-state', compact('users', 'state', 'office', 'ticket_type', 'payment_type', 'ticket_status', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the sales by credit card report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printAccountReceivable($office_id, $date_type, $start_date, $end_date)
    {
        $office = Office::find($office_id)->name;

        $users = User::where('office_id', $office_id)->whereHas('tickets', function($tickets) use($date_type, $start_date, $end_date) {
                if($date_type == 'false' || !$date_type) {
                    $tickets->whereDate('purchase_date', $start_date);
                } else {
                    $tickets->where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date);
                }
        })->get();   

        foreach ($users as $user) {
            if($date_type == 'false' || !$date_type) {
                $tickets = $user->tickets->whereDate('purchase_date', $start_date);
            } else {
                $tickets = $user->tickets->where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date);
            }

            $user['tickets'] = $tickets;

            $user['total'] = $tickets->sum('total_sale');
        }
    

        $pdf = PDF::loadView('pages.reports.pdf.receivable', compact('office', 'users', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a3', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the sales by agency report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printSalesByAgency($terminal_ids, $office_ids, $date_type, $start_date, $end_date)
    {
        $office_ids = json_decode($office_ids);
        $terminal_ids = json_decode($terminal_ids);

        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('purchase_date', $start_date)->whereHas('seller', function($seller) use($office_ids) {
                $seller->whereIn('office_id', $office_ids);
            })->get();
        } else {
            $tickets = Ticket::where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date)->whereHas('seller', function($seller) use($office_ids) {
                $seller->whereIn('office_id', $office_ids);
            })->get();
        }



        $agencies = Office::whereIn('id', $office_ids)->pluck('name');
        $terminals = Office::whereIn('departure_city_id', $terminal_ids)->pluck('name');

        $agencies = implode(', ', $agencies->toArray());
        $terminals = implode(', ', $terminals->toArray());

        $pdf = PDF::loadView('pages.reports.pdf.sales-by-agency', compact('agencies', 'terminals', 'tickets', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a2', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the billing by ticket card report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printBillingByTickets($date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('purchase_date', $start_date);
        } else {
            $tickets = Ticket::where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date);
        }

        $tickets_by_terminal_unique = $tickets->get()->count();
        $tickets_by_terminal_by_section = $tickets->get()->count();
        $tickets_by_terminal_total = $tickets->sum('total_sale') + $tickets->sum('total_sale');


        $total_sold_ticket_sold_unique = $tickets->get()->count();
        $total_sold_ticket_sold_bysection = $tickets->get()->count();
        $total_sold_unique_and_bysection = $tickets->sum('total_sale') + $tickets->sum('total_sale');

        $total_agency_paid_confirmed_tickets_unique = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agency_paid_confirmed_tickets_bysection = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agency_paid_confirmed_tickets_total = $tickets->where('payment_status', 'Paid')->sum('total_sale') + $tickets->where('payment_status', 'Paid')->sum('total_sale');

        $total_agent_paid_confirmed_tickets_unique = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agent_paid_confirmed_tickets_bysection = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agent_paid_confirmed_tickets_total = $tickets->where('payment_status', 'Paid')->sum('total_sale') + $tickets->where('payment_status', 'Paid')->sum('total_sale');

        $pdf = PDF::loadView('pages.reports.pdf.billing-by-tickets', compact('tickets_by_terminal_unique', 'tickets_by_terminal_by_section', 'tickets_by_terminal_total', 'total_sold_ticket_sold_unique', 'total_sold_ticket_sold_bysection', 'total_sold_unique_and_bysection', 'total_agency_paid_confirmed_tickets_unique', 'total_agency_paid_confirmed_tickets_bysection', 'total_agency_paid_confirmed_tickets_total', 'total_agent_paid_confirmed_tickets_unique', 'total_agent_paid_confirmed_tickets_bysection', 'total_agent_paid_confirmed_tickets_total', 'date_type', 'start_date', 'end_date'));
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the billing by transaction report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printBillingByTransaction($date_type, $start_date, $end_date)
    {
        if($date_type == 'false' || !$date_type) {
            $tickets = Ticket::whereDate('purchase_date', $start_date);
        } else {
            $tickets = Ticket::where('purchase_date', '>=', $start_date)->where('purchase_date', '<=', $end_date);
        }

        $tickets_by_terminal_unique = $tickets->get()->count();
        $tickets_by_terminal_by_section = $tickets->get()->count();
        $tickets_by_terminal_total = $tickets->sum('total_sale') + $tickets->sum('total_sale');


        $total_sold_ticket_sold_unique = $tickets->get()->count();
        $total_sold_ticket_sold_bysection = $tickets->get()->count();
        $total_sold_unique_and_bysection = $tickets->sum('total_sale') + $tickets->sum('total_sale');

        $total_agency_paid_confirmed_tickets_unique = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agency_paid_confirmed_tickets_bysection = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agency_paid_confirmed_tickets_total = $tickets->where('payment_status', 'Paid')->sum('total_sale') + $tickets->where('payment_status', 'Paid')->sum('total_sale');

        $total_agent_paid_confirmed_tickets_unique = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agent_paid_confirmed_tickets_bysection = $tickets->where('payment_status', 'Paid')->get()->count();
        $total_agent_paid_confirmed_tickets_total = $tickets->where('payment_status', 'Paid')->sum('total_sale') + $tickets->where('payment_status', 'Paid')->sum('total_sale');

        $pdf = PDF::loadView('pages.reports.pdf.billing-by-transactions', compact('tickets_by_terminal_unique', 'tickets_by_terminal_by_section', 'tickets_by_terminal_total', 'total_sold_ticket_sold_unique', 'total_sold_ticket_sold_bysection', 'total_sold_unique_and_bysection', 'total_agency_paid_confirmed_tickets_unique', 'total_agency_paid_confirmed_tickets_bysection', 'total_agency_paid_confirmed_tickets_total', 'total_agent_paid_confirmed_tickets_unique', 'total_agent_paid_confirmed_tickets_bysection', 'total_agent_paid_confirmed_tickets_total', 'date_type', 'start_date', 'end_date'));
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }

    /**
     * Handle the billing by transaction report print
     *
     * @param Illuminate\Http\Request $request
     * @return Illuminate\Http\Response
     */
    
    public function printPassenger($type, $trip_id, $route_id, $date_type, $start_date, $end_date)
    {

        $trip = Trip::findOrFail($trip_id);
        $route = Route::findOrFail($route_id);
        $main_driver = $trip->driver->fullname;
        $secondary_driver = $trip->main_co_driver ? $trip->main_co_driver->fullname : $trip->driver->fullname;

        $list = [];

        switch ($type) {
            case 'Operators Manifest':
                $list = Ticket::where('trip_id', $trip_id)->get();
                break;

            case 'Boarded Passenger List':
            $list = Ticket::where('trip_id', $trip_id)->where('boarding_status', 'Boarded')->get()->groupBy('departure.name');
                break;

            default:
                $list = Ticket::where('trip_id', $trip_id)->get()->groupBy('departure.name');
                break;
        }

        $pdf = PDF::loadView('pages.reports.pdf.passenger', compact('type', 'trip', 'route', 'main_driver', 'secondary_driver', 'list', 'date_type', 'start_date', 'end_date'));
        $pdf->setPaper('a4', 'landscape');
        $content = $pdf->download()->getOriginalContent();

        Storage::put('public/report.pdf',$content) ;
        // return view('pages.reports.pdf.daily-till-closure');
        return $pdf->download('report.pdf');
    }
}
