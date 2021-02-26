<?php

namespace App\Http\Controllers;

use App\Http\Fetch\OfficeFetch;
use App\Http\Resources\OfficeCollection;
use Illuminate\Http\Request;

use App\Models\Office;
use App\Models\City;
use App\Models\UsState;
use App\Models\OfficeType;
use App\Models\Terminal;

class OfficeController extends Controller
{
    protected $fetch;

    /**
     * Create new controller instance
     * 
     * @return void
     */
    public function __construct(OfficeFetch $fetch)
    {
        $this->fetch = $fetch;
    }

    /**
     * Show office index page
     * 
     * @return Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.office.index', [
            'headers' => OfficeCollection::$headers,
            'searches' => OfficeCollection::$searches,
        ]);
    }

    /**
     * Fetch all offices
     * 
     * @return Illuminate\Http\Response
     */
    public function fetch()
    {
        return new OfficeCollection($this->fetch->execute(request()->input()));
    }

    /**
     * Show offices create page
     * 
     * @return Illuminate\Http\Response
     */
    public function create()
    {

        return view('pages.office.create', [
            'office_types' => OfficeType::get(),
            'cities' => City::get(),
            'states' => UsState::get(),
            'terminals' => Terminal::get(),
            'agencies' => [],
        ]);
    }

    /**
     * Show users view page
     * 
     * @return Illuminate\Http\Response
     */
    public function show($id)
    {
        $office = Office::withTrashed()->find($id);
        return view('pages.office.show', [
            'office_types' => OfficeType::get(),
            'cities' => City::get(),
            'states' => UsState::get(),
            'terminals' => Terminal::get(),
            'agencies' => [],

            'office' => $office
        ]);
    }
}
