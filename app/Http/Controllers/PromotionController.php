<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\PromotionCollection;
use App\Http\Fetch\PromotionFetch;

use App\Models\Promotion;
use App\Models\Route;
use App\Models\City;

class PromotionController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(PromotionFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\PromotionMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.promotion.index', [
            'headers' => PromotionCollection::$headers,
            'searches' => PromotionCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new PromotionCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        $routes = Route::get();
        $cities = City::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];

        return view('pages.promotion.create', [
            'routes' => $routes,
            'cities' => $cities,
            'types_filter' => collect(Promotion::getType()),
            'filter_by' => $filter_by,
            'day_filter' => collect(Promotion::getDayFilter()),
            'apply_to_filter' => collect(Promotion::getApplyTo()),
            'ticket_filter' => collect(Promotion::getTicket()),
            'day_list' => collect(Promotion::getDayList()),
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
        $promotion = Promotion::withTrashed()->findOrFail($id);
        $promotion['routeIds'] = $promotion->routeSpecifieds()->pluck('route_id');
        $promotion['departureIds'] = $promotion->partOfRoutes->whereNotNull('departure_id')->pluck('departure_id');
        $promotion['arrivalIds'] = $promotion->partOfRoutes()->whereNotNull('arrival_id')->pluck('arrival_id');
        $routes = Route::get();
        $cities = City::get();
        $filter_by = [
            [ 'label' => 'Day'], [ 'label' => 'Date Range']
        ];
        $promotion['days_selected'] = $promotion->days ? $promotion->days : collect(array());

        return view('pages.promotion.show', [
            'promotion' => $promotion,
            'routes' => $routes,
            'cities' => $cities,
            'types_filter' => collect(Promotion::getType()),
            'filter_by' => collect($filter_by),
            'day_filter' => collect(Promotion::getDayFilter()),
            'apply_to_filter' => collect(Promotion::getApplyTo()),
            'ticket_filter' => collect(Promotion::getTicket()),
            'day_list' => collect(Promotion::getDayList()),
        ]);
    }

}
