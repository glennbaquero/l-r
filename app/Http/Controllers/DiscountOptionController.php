<?php

namespace App\Http\Controllers;

use App\Http\Fetch\DiscountOptionFetch;
use App\Http\Resources\DiscountOptionCollection;
use Illuminate\Http\Request;

use App\Models\DiscountIncreaseOption;

class DiscountOptionController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(DiscountOptionFetch $fetch)
    {
        $this->middleware('App\Http\Middleware\DiscountOptionMiddleware');
        $this->fetch = $fetch;
    }

    /**
     * Show users index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.discount-option.index', [
            'headers' => DiscountOptionCollection::$headers,
            'searches' => DiscountOptionCollection::$searches,
        ]);
    }

    /**
     * Fetch all users
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new DiscountOptionCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show users create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.discount-option.create', [
            'types' => collect(DiscountIncreaseOption::getType())
        ]);
    }

    /**
     * Show users view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.discount-option.show', [
            'option' => DiscountIncreaseOption::withTrashed()->findOrFail($id),
            'types' => collect(DiscountIncreaseOption::getType())
        ]);
    }
}
