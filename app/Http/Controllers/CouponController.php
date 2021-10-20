<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\CouponCollection;
use App\Http\Fetch\CouponFetch;

use App\Models\Coupon;
use App\Models\Route;
use App\Models\City;
use App\Models\Service;
use App\Models\TicketType;
use App\Models\User;

class CouponController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(CouponFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\CouponMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.coupon.index', [
            'headers' => CouponCollection::$headers,
            'searches' => CouponCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new CouponCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::get();
        $cities = City::orderby('name', 'asc')->get();
        $services = Service::get();
        $ticket_types = TicketType::get();
        $users = User::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];
        $applies_to = [
            [ 'label' => 'System'], [ 'label' => 'Web'], [ 'label' => 'All'], 
        ];

        return view('pages.coupon.create', [
            'routes' => $routes,
            'cities' => $cities,
            'services' => $services,
            'users' => $users,
            'ticket_types' => $ticket_types,
            'trip_type' => collect(Coupon::getTripType()),
            'filter_by' => collect($filter_by),
            'base_fare' => collect(Coupon::getBaseFare()),
            'apply_to_filter' => collect(Coupon::getApplyTo()),
            'coupon_type' => collect(Coupon::getCouponType()),
            'day_list' => collect(Coupon::getDayList()),
            'filter_date' => collect(Coupon::getFilterDate()),
            'filter_day_range' => collect(Coupon::getFilterDayRange()),
            'applies_to' => collect($applies_to),
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $array = [];
        $coupon = Coupon::withTrashed()->findOrFail($id);
        $routes = Route::get();
        $cities = City::orderby('name', 'asc')->get();
        $services = Service::get();
        $ticket_types = TicketType::get();
        $users = User::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];
        $applies_to = [
            [ 'label' => 'System'], [ 'label' => 'Web'], [ 'label' => 'All'], 
        ];
        $coupon['days_selected'] = $coupon->days ? $coupon->days : collect(array());
        $coupon['service_ids'] = $coupon->services()->pluck('service_id');
        $coupon['ticket_type_ids'] = $coupon->ticketTypes()->pluck('ticket_type_id');
        $coupon['route_ids'] = $coupon->routes()->pluck('route_id');
        $coupon['departureIds'] = $coupon->generalRoutes()->whereNotNull('departure_id')->pluck('departure_id');
        $coupon['arrivalIds'] = $coupon->generalRoutes()->whereNotNull('arrival_id')->pluck('arrival_id');

        return view('pages.coupon.show', [
            'coupon' => $coupon,
            'routes' => $routes,
            'cities' => $cities,
            'services' => $services,
            'users' => $users,
            'ticket_types' => $ticket_types,
            'trip_type' => collect(Coupon::getTripType()),
            'filter_by' => collect($filter_by),
            'base_fare' => collect(Coupon::getBaseFare()),
            'apply_to_filter' => collect(Coupon::getApplyTo()),
            'coupon_type' => collect(Coupon::getCouponType()),
            'day_list' => collect(Coupon::getDayList()),
            'filter_date' => collect(Coupon::getFilterDate()),
            'filter_day_range' => collect(Coupon::getFilterDayRange()),
            'applies_to' => collect($applies_to),
        ]);
    }

}
