<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\TicketCollection;
use App\Http\Fetch\TicketFetch;

use App\Http\Fetch\PreprocessTicketFetch;
use App\Http\Resources\PreprocessTicketCollection;

use Illuminate\Validation\ValidationException;

use App\Notifications\NotifyPassenger;
use App\Notifications\TicketNotifyPassenger;

use App\Models\Ticket;
use App\Models\TicketType;
use App\Models\City;
use App\Models\Stop;
use App\Models\Trip;
use App\Models\TripTime;
use App\Models\Passenger;
use App\Models\Price;
use App\Models\Coupon;
use App\Models\Voucher;
use App\Models\Route;
use App\Models\PreprocessTicket;
use App\Models\Bus;

use Carbon\Carbon;
use DB;
use Session;

class TicketController extends Controller
{    
	protected $fetch;
    protected $preprocess_fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(TicketFetch $fetch, PreprocessTicketFetch $preprocess_fetch)
    {
        $this->middleware('App\Http\Middleware\TicketMiddleware', ['only' => ['index', 'printTicket']]);
        $this->fetch = $fetch;
        $this->preprocess_fetch = $preprocess_fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        $user = auth()->user();
        $existing_cash = $user->cashes()->where('office_id', $user->office_id)->whereDate('created_at', now())->first();

        if(! $existing_cash) {  
            return redirect()->route('open-cash.index');
        } 

        return view('pages.ticket.index', [
            'headers' => TicketCollection::$headers,
            'searches' => TicketCollection::$searches,
            'cities' => City::orderby('name', 'asc')->get(),
            'ticket_types' => TicketType::get(),
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch($office_id = null, $office_view = null)
    {

        if($office_id) {
            request()->request->add(['office_id' => $office_id]);
        }

        if($office_view) {
            request()->request->add(['office_view' => true]);
        } else {
            request()->request->add(['office_view' => false]);
        }
        return new TicketCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetchPreprocessTicket($office_id = null, $office_view = null)
    {

        if($office_id) {
            request()->request->add(['office_id' => $office_id]);
        }

        if($office_view) {
            request()->request->add(['office_view' => true]);
        } else {
            request()->request->add(['office_view' => false]);
        }
        return new PreprocessTicketCollection($this->preprocess_fetch->execute(request()->input()));
    }

    /**
     * Find available trip from selected departure and arrival
     *
     * @return array $trips
     */
    
    public function findAvailableTrip(Request $request)
    {
        $departure = $request->departure_id;
        $arrival = $request->arrival_id;

        $stops = Stop::where('departure_id', $departure)->get();

        $trips = [];
        $available_dates = [];
        $buses = [];

        $start_of_day = now()->startOfDay()->format('H:i:s');
        $end_of_day = now()->endOfDay()->format('H:i:s');

        foreach ($stops as $departure_stop) {
            // if($departure_stop->route->stops()->where('arrival_id', $arrival)->whereTime('schedule_start', '>=', now())->whereTime('schedule_end', '<=', now())->count()) {
            if($departure_stop->route->stops()->where('arrival_id', $arrival)->whereTime('schedule_start', '>=', $start_of_day)->whereTime('schedule_end', '<=', $end_of_day)->count()) {
                // $arrival_stops = $departure_stop->route->stops()->where('arrival_id', $arrival)->whereTime('schedule_start', '>=', now())->whereTime('schedule_end', '<=', now())->get();
                $arrival_stops = $departure_stop->route->stops()->where('arrival_id', $arrival)->whereTime('schedule_start', '>=', $start_of_day)->whereTime('schedule_end', '<=', $end_of_day)->get();
                foreach ($arrival_stops as $stop) {
                    if(!collect($trips)->contains('route', $stop->route)) {
                        $availableTrips = $stop->route->trips()->where('date', '>=', now());
                        if($availableTrips->count()) {
                            if(!collect($trips)->contains('trips', $availableTrips->get())) {
                                array_push($trips, [
                                    'route' => $stop->route,
                                    'trips' => $availableTrips->orderby('date', 'asc')->get(),
                                ]);   

                                $available_dates = $availableTrips->pluck('date');
                                // $buses = $availableTrips->pluck('bus_id')->toArray();
                            }

                        }
                    }
                }
            }
        }

        $buses = array_unique($buses);

        $price = Price::where('departure_id', $departure)->where('arrival_id', $arrival)->first();

        if(!$price && $request->filled('departure_id') && $request->filled('arrival_id')) {
            throw ValidationException::withMessages([
                'error' => ['No available price for the selected departure to arrival.']
            ]);
        }

        return response()->json([
            'trips' => $trips,
            'price' => $price,
            // 'buses' => Bus::whereIn('id', $buses)->get(),
            'available_dates' => $available_dates
        ]);

    }

    /**
     * get all the trip time
     *
     * @return array $trips
     */
    
    public function getTripTime(Request $request)
    {
        $trips = Trip::whereIn('id', $request->trip_ids)->where('bus_id', $request->bus_id)->pluck('id');
        $time = TripTime::whereIn('trip_id', $trips)->get();
        return response()->json([
            'time' => $time
        ]);
    }

    public function getAvailableBus(Request $request)
    {
        $bus_ids = Trip::whereIn('id', $request->trip_ids)->pluck('bus_id');
        $buses = Bus::whereIn('id', $bus_ids)->get();
        return response()->json([
            'buses' => $buses
        ]);
    }

    /**
     * Fetch bus from selected trip
     *
     * @return array $trips
     */
    
    public function getBus(Request $request)
    {
        $time = TripTime::find($request->time_id);
        $trip = Trip::find($time->trip_id);
        // $rows = $trip->bus->bus_model->bus_rows;
        $rows = $time->bus->bus_model->bus_rows;
        $bus_model = [];

        foreach ($rows as $row) {
           $this->renderBusModel($row, $trip, $request);
           array_push($bus_model, $row->bus_columns);

        }
        return response()->json([
            'bus_model' => $bus_model,
            'bus' => $time->bus
        ]);

    }

    // public function renderBusModel($row, $trip, $request) {

    //     $response = [];

    //     foreach ($row->bus_columns as $column) {
    //         foreach($trip->passengers as $key => $passenger) {
    //             $last_stop = $trip->route->stops()->latest()->orderby('id', 'desc')->first();

    //             if($last_stop->arrival_id === $passenger->arrival_city_id) {
    //                 if($passenger->bus_model_column_id == $column->id) {
    //                     $column['passenger'] = $passenger;

    //                     if($passenger->ticket->payment_method == 'Cash' || $passenger->ticket->payment_method == 'Credit Card') {
    //                         $column->image_path = url('icons/seat_sold.png');
    //                     } elseif ($passenger->ticket->payment_method == 'Reservation') {
    //                         $column->image_path = url('icons/seat_reserve.png');
    //                     }

    //                     // $seat = $passenger->bus_model_column_id;
    //                     // $checker = $trip->passengers()->where('bus_model_column_id', $seat)->whereNoIn('arrival_city_id', [$request->arrival_id])->count();

    //                     // if($checker) {
    //                     //     $column->image_path = url('icons/seat_available.png');
    //                     // }
                    
    //                     $column->is_reserved = true;
    //                 }
    //             } elseif ($passenger->arrival_city_id == $request->arrival_id) {
    //                 if($passenger->bus_model_column_id == $column->id) {
    //                     $column['passenger'] = $passenger;

    //                     if($passenger->ticket->payment_method == 'Cash' || $passenger->ticket->payment_method == 'Credit Card') {
    //                         $column->image_path = url('icons/seat_sold.png');
    //                     } elseif ($passenger->ticket->payment_method == 'Reservation') {
    //                         $column->image_path = url('icons/seat_reserve.png');
    //                     }
    //                     $column->is_reserved = true;
    //                 }
    //             }


    //             if($passenger->ticket->departure_id == $request->departure_id && $passenger->arrival_city_id == $request->arrival_id) {
    //                 if($passenger->bus_model_column_id == $column->id) {
    //                     $column['passenger'] = $passenger;

    //                     if($passenger->ticket->payment_method == 'Cash' || $passenger->ticket->payment_method == 'Credit Card') {
    //                         $column->image_path = url('icons/seat_sold.png');
    //                     } elseif ($passenger->ticket->payment_method == 'Reservation') {
    //                         $column->image_path = url('icons/seat_reserve.png');
    //                     }
    //                     $column->is_reserved = true;
    //                 }
    //             } 
    //         }
    //     }

    //     return true;
    // }

    public function renderBusModel($row, $trip, $request) {

        $response = [];
        $arrival_ids = array_values(array_unique($trip->tickets->pluck('arrival_id')->toArray()));
        $destination_ids = array_values(array_unique($trip->tickets->pluck('destination_id')->toArray()));

        foreach ($row->bus_columns as $column) {
            foreach($trip->tickets as $key => $ticket) {
                $last_stop = $trip->route->stops()->latest()->orderby('id', 'desc')->first();

                if($last_stop->arrival_id === $ticket->arrival_id) {
                    if($ticket->bus_model_column_id == $column->id) {
                        $column['passenger'] = $ticket->passenger;

                        if($ticket->payment_method == 'Cash' || $ticket->payment_method == 'Credit Card' || $ticket->payment_method == 'External Credit Card' ) {
                            // $column->image_path = url('icons/seat_sold.png');
                             $column->image_path = url('icons/sold_seat.png');
                        } elseif ($ticket->payment_method == 'Reservation') {
                            $column->image_path = url('icons/seat_reserve.png');
                            // $column->image_path = url('icons/reserved_seat.png');
                        }

                        $column->is_reserved = true;
                    }
                } elseif ($ticket->arrival_id == $request->arrival_id) {
                    if($ticket->bus_model_column_id == $column->id) {
                        $column['passenger'] = $ticket->passenger;

                        if($ticket->payment_method == 'Cash' || $ticket->payment_method == 'Credit Card' || $ticket->payment_method == 'External Credit Card') {
                            // $column->image_path = url('icons/seat_sold.png');
                            $column->image_path = url('icons/sold_seat.png');
                        } elseif ($ticket->payment_method == 'Reservation') {
                            $column->image_path = url('icons/seat_reserve.png');
                            // $column->image_path = url('icons/reserved_seat.png');
                        }
                        $column->is_reserved = true;
                    }
                }


                if($ticket->departure_id == $request->departure_id && $ticket->arrival_id == $request->arrival_id) {
                    if($ticket->bus_model_column_id == $column->id) {
                        $column['passenger'] = $ticket->passenger;

                        if($ticket->payment_method == 'Cash' || $ticket->payment_method == 'Credit Card' || $ticket->payment_method == 'External Credit Card') {
                            // $column->image_path = url('icons/seat_sold.png');
                            $column->image_path = url('icons/sold_seat.png');
                        } elseif ($ticket->payment_method == 'Reservation') {
                            $column->image_path = url('icons/seat_reserve.png');
                            // $column->image_path = url('icons/reserved_seat.png');
                        }
                        $column->is_reserved = true;
                    }
                } 

                if($ticket->arrival_id == $request->departure_id) {
                    if($ticket->bus_model_column_id == $column->id) {
                        // $column['passenger'] = $ticket->passenger;

                        $column->image_path = url('icons/seat_double_sold.png');
                        // $column->image_path = url('icons/fixed_seat.png');
                    }
                }
            }
        }

        return true;
    }

    /**
     * Fetch passenger
     *
     * @return array $trips
     */
    
    public function getPassenger(Request $request)
    {
        $passengers = [];
        if($request->filled('search')) {
            $passengers = Passenger::whereLike('phone_number', $request->search)->orWhereLike('last_name', $request->search)->orWhereLike('first_name', $request->search)->get();
        }

        return response()->json([
            'passengers' => $passengers
        ]);

    }

    public function printTicket($id, $passenger, $arrival, $departure, $preprocess=false) 
    {
        if($preprocess) {
            $ticket = PreprocessTicket::find($id);
        } else {
            $ticket = Ticket::find($id);
        }


        $departure = $ticket->departure->name;
        $arrival = $ticket->arrival->name;

        if($ticket->departure->offices()->where('office_type_id', 6)->count()) {
            $departure = $ticket->departure->offices()->where('office_type_id', 6)->first()->address_line_1;
        }

        if($ticket->arrival->offices()->where('office_type_id', 6)->count()) {
            $arrival = $ticket->arrival->offices()->where('office_type_id', 6)->first()->address_line_1;
        }

        return view('pages.ticket.print', [
            'ticket' => $ticket,
            'departure' => $departure,
            'arrival' => $arrival,
        ]);
    }

    public function scanTicketQR($id, $passenger, $arrival, $departure) 
    {
        $ticket = Ticket::find($id);
        $ticket->update([
            'boarding_status' => 'On Board',
            'payment_status' => 'Paid',
        ]);

        return response()->json([
            'success' => true
        ]);
    }


    public function couponValidate(Request $request)
    {
        $dayOfTrip = Carbon::parse($request->trip_date)->format('l');

        $coupon = Coupon::where('code', $request->code)->where('trip_date', '<=', $request->trip_date)->where('trip_end_date', '>=', $request->trip_date)->whereNotIn('coupon_available', [0])->first();

        if(!$coupon) {
            return response()->json([
                'title' => 'Coupon validate failed!',
                'message' => 'Sorry, the code is not available.',
                'success' => false
            ]);
        }

        $validateRouteisAvailable = $coupon->routes()->where('route_id', $request->route_id)->count();

        if(!$validateRouteisAvailable) {
            return response()->json([
                'title' => 'Coupon validate failed!',
                'message' => 'Sorry, the code is not available.',
                'success' => false
            ]);
        }

        $trip_days = is_array($coupon->trip_days) ? $coupon->trip_days : json_decode($coupon->trip_days);

        foreach ($trip_days as $key => $available_day) {
            if($dayOfTrip == $available_day) {

                $discount = 0;

                switch ($coupon->coupon_type) {
                    case 'Percentage':
                        $discount = $coupon->value / 100;
                        break;
                    
                    default:
                        $discount = $coupon->value;
                        break;
                }

                return response()->json([
                    'coupon' => $coupon,
                    'discount' => $discount,
                    'success' => true,
                    'title' => 'Coupon validate success!',
                    'message' => 'Coupon applied!'
                ]);
            }
        }

        return response()->json([
            'title' => 'Coupon validate failed!',
            'message' => 'Sorry, the code is not available.',
            'success' => false
        ]);
    }

    public function passengerEmailSender(Request $request, $id)
    {
        $passenger = Passenger::withTrashed()->findOrFail($id);
        $passenger->notify(new NotifyPassenger($request->message, $request->subject));


        return response()->json([
            'message' => 'sent successfully',
            'success' => true
        ]);
    }

    public function registerPayment(Request $request) 
    {
        $tickets = Ticket::whereIn('id', $request->ids)->get();

        foreach($tickets as $ticket) {
            $ticket->update([
                'is_registered_payment' => true
            ]);
        }
        

        return response()->json([
            'message' => 'Registered successfully',
            'success' => true
        ]);
    }


    // public function voucherValidate(Request $request)
    // {

    //     $voucher = Voucher::where('code', $request->code)->whereDate('expiration_date', '>', $request->trip_date)->first();

    //     if(!$voucher) {
    //         return response()->json([
    //             'title' => 'Voucher validate failed!',
    //             'message' => 'Sorry, the code is not available.',
    //             'success' => false
    //         ]);
    //     }

    //     if($voucher->passenger->fullname == $request->passenger) {
    //         /**
    //          * @ToDo passenger id in ticket model so that we can summarize the voucher used via tickets
    //          */
    //         $voucher_used_by_passenger = Ticket::where('voucher_code', $request->code)->count();

    //         if($voucher->type_of_voucher === 'Max. Ticket % Discount') {

    //             if($voucher_used_by_passenger < $voucher->max_no_of_discount_ticket) {
    //                 $discount = $voucher->discount_percent / 100;
    //             } else {
    //                 return response()->json([
    //                     'title' => 'Voucher validate failed!',
    //                     'message' => 'Sorry, the code is reached the max usage.',
    //                     'success' => false
    //                 ]);
    //             }

    //         } else {
    //             $discount = $voucher->amount;
    //         }

    //         return response()->json([
    //             'voucher' => $voucher,
    //             'discount' => $discount,
    //             'success' => true,
    //             'title' => 'Voucher validate success!',
    //             'message' => 'Voucher applied!'
    //         ]);
    //     } else {
    //         return response()->json([
    //             'title' => 'Voucher validate failed!',
    //             'message' => 'Sorry, the code is not for the passenger.',
    //             'success' => false
    //         ]);
    //     }


    //     return response()->json([
    //         'title' => 'Voucher validate failed!',
    //         'message' => 'Sorry, the code is not available.',
    //         'success' => false
    //     ]);
    // }


    public function ticketConfirmation($id, $passenger, $arrival, $departure) 
    {
        $ticket = PreprocessTicket::find($id);
        $departure = $ticket->departure->name;
        $arrival = $ticket->arrival->name;

        if($ticket->departure->offices()->where('office_type_id', 6)->count()) {
            $departure = $ticket->departure->offices()->where('office_type_id', 6)->first()->address_line_1;
        }

        if($ticket->arrival->offices()->where('office_type_id', 6)->count()) {
            $arrival = $ticket->arrival->offices()->where('office_type_id', 6)->first()->address_line_1;
        }

        $payloads['id'] = $ticket->id;

        $trip_time = $ticket->trip_time ? $ticket->trip_time->formatted_time : now()->format('h:i A');
        $travel_date = Carbon::parse($ticket->trip->date)->format('F d, Y').' '.$trip_time;

        if($ticket->confirmed && $ticket->confirmation_date) {
            return redirect()->route('ticket.verified');
        }

        return view('pages.ticket.show', [ 
            'ticket' => $ticket, 
            'departure' => $departure, 
            'arrival' => $arrival,
            'travel_date' => $travel_date,
            'payloads' => collect($payloads),
        ]);
    }


    public function confirmedTicket(Request $request) 
    {
        $ticket = PreprocessTicket::find($request->id);
        DB::beginTransaction();
            $ticket->update([
                'confirmed' => true,
                'confirmation_date' => now() 
            ]);

            $ticket = Ticket::create([
                'passenger_id' => $ticket->passenger_id,
                'seller_id' => $ticket->seller_id,
                'arrival_id' => $ticket->arrival_id,
                'departure_id' => $ticket->departure_id,
                'trip_id' => $ticket->trip_id,
                'bus_model_column_id' => $ticket->bus_model_column_id,
                'number_of_ticket' => $ticket->number_of_ticket,
                // 'reservation_code' => $ticket->reservation_code,
                'reservation_date' => $ticket->reservation_date,
                'purchase_date' => $ticket->purchase_date,
                'voucher_code' => $ticket->voucher_code,
                'payment_method' => $ticket->payment_method,
                'total_sale' => $ticket->total_sale,
                'boarding_status' => $ticket->boarding_status,
                'payment_status' => $ticket->payment_status,
                'is_cancelled' => $ticket->is_cancelled,
                'new_seat_id' => $ticket->new_seat_id,
                'is_registered_payment' => $ticket->is_registered_payment,
                'office_id' => $ticket->office_id,
            ]);

            $route = route('ticket.print', [$ticket->id, $ticket->passenger->fullname, $ticket->arrival->name, $ticket->departure->name]);
            
            $ticket->passenger->notify(new TicketNotifyPassenger('Your reservation is confirmed, you can download here the copy of your ticket.', $route));
        DB::commit();


        return response()->json([
            'success' => true,
            'header'=> 'Your reservation is confirmed, you can download the copy of your ticket in your email. Thank you!'
        ]);
    }

    public function ticketVerified() 
    {
        return view('pages.ticket.verified');
    }

    public function ticketStatus($status, $id = null, $passenger = null, $arrival = null, $departure = null) 
    {
        $ticket = null;
        $travel_date = null;
        $route = route('ticket.status', ['not yet been process']);

        if($status == 'paid') {
            $ticket = Ticket::find($id);
            $trip_time = $ticket->trip_time ? $ticket->trip_time->formatted_time : now()->format('h:i A');
            $travel_date = Carbon::parse($ticket->trip->date)->format('F d, Y').' '.$trip_time;
            $route = $ticket->updateStatusUrl();
        }

        return view('pages.ticket.status', [
            'status' => $status,
            'ticket' => $ticket,
            'travel_date' => $travel_date,
            'route' => $route,
        ]);
    }

    public function transactionNumberPage()
    {
        return view('pages.qr.enter-transaction');
    }

    public function validateTransactionNumber(Request $request)
    {
        $ticket = Ticket::where('transaction_number', $request->transaction_number)->first();
        
        $ticket->update([
            'boarding_status' => 'On Board',
            'payment_status' => 'Paid',
        ]);

        return response()->json([
            'success' => true
        ]);
    }
}
