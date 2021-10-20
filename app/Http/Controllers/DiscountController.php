<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\DiscountCollection;
use App\Http\Fetch\DiscountFetch;

use App\Http\Resources\MostUsedCouponCollection;
use App\Http\Fetch\MostUsedCouponFetch;

use App\Models\Discount;
use App\Models\Route;
use App\Models\MultiRoute;
use App\Models\City;
use App\Models\Service;
use App\Models\TicketType;
use App\Models\User;

class DiscountController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(MostUsedCouponFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\DiscountMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show discounts index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.discount.index', [
            'headers' => MostUsedCouponCollection::$headers,
            'searches' => MostUsedCouponCollection::$searches,
        ]);
    }

    /**
     * Fetch all discounts
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new MostUsedCouponCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show discount create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::get();
        $cities = City::orderby('name', 'asc')->get();
        $services = Service::get();
        $ticket_types = TicketType::get();
        $multi_routes = MultiRoute::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];

        return view('pages.discount.create', [
            'routes' => $routes,
            'multi_routes' => $multi_routes,
            'cities' => $cities,
            'services' => $services,
            'ticket_types' => $ticket_types,
            'trip_type' => collect(Discount::getTripType()),
            'filter_by' => collect($filter_by),
            'apply_to_filter' => collect(Discount::getApplyTo()),
            'discount_type' => collect(Discount::getDiscountType()),
            'day_list' => collect(Discount::getDayList()),
            'filter_day_range' => collect(Discount::getFilterDayRange()),
            'applies_to' => collect(Discount::getPromotionAppliesTo()),
            'change_types' => collect(Discount::getChangeType()),
        ]);
    }

    /**
     * Show discount view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $array = [];
        $discount = Discount::withTrashed()->findOrFail($id);
        $routes = Route::get();
        $cities = City::orderby('name', 'asc')->get();
        $services = Service::get();
        $ticket_types = TicketType::get();
        $multi_routes = MultiRoute::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];
        $discount['days_selected'] = $discount->days ? $discount->days : collect(array());
        $discount['service_ids'] = $discount->services()->pluck('service_id');
        $discount['ticket_type_ids'] = $discount->ticketTypes()->pluck('ticket_type_id');
        $discount['route_ids'] = $discount->routes()->pluck('route_id');
        $discount['multi_route_ids'] = $discount->multiRoutes()->pluck('multi_route_id');
        $discount['departureIds'] = $discount->generalRoutes()->whereNotNull('departure_id')->pluck('departure_id');
        $discount['arrivalIds'] = $discount->generalRoutes()->whereNotNull('arrival_id')->pluck('arrival_id');

        return view('pages.discount.show', [
            'discount' => $discount,
            'routes' => $routes,
            'multi_routes' => $multi_routes,
            'cities' => $cities,
            'services' => $services,
            'ticket_types' => $ticket_types,
            'trip_type' => collect(Discount::getTripType()),
            'filter_by' => collect($filter_by),
            'apply_to_filter' => collect(Discount::getApplyTo()),
            'discount_type' => collect(Discount::getDiscountType()),
            'day_list' => collect(Discount::getDayList()),
            'filter_day_range' => collect(Discount::getFilterDayRange()),
            'applies_to' => collect(Discount::getPromotionAppliesTo()),
            'change_types' => collect(Discount::getChangeType()),
        ]);
    }

}
