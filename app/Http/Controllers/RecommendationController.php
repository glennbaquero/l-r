<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Resources\RecommendationCollection;
use App\Http\Fetch\RecommendationFetch;

use App\Models\Recommendation;

class RecommendationController extends Controller
{    
	protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(RecommendationFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\RecommendationMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show recommendation index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.recommendation.index', [
            'headers' => RecommendationCollection::$headers,
            'searches' => RecommendationCollection::$searches,
        ]);
    }

    /**
     * Fetch all recommendation
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new RecommendationCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show recommendation create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.recommendation.create', [
            //
        ]);
    }

    /**
     * Show groups view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $recommendation = Recommendation::withTrashed()->findOrFail($id);

        return view('pages.recommendation.show', [
            'recommendation' => $recommendation
        ]);
    }

}
